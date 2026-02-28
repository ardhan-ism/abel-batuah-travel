<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\CarterDetail;
use App\Models\Schedule;
use App\Services\FonnteService;
use App\Services\SettingService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\BookingNotification;

class BookingController extends Controller
{
public function create(Request $request)
{
    $schedule = Schedule::with('route')->findOrFail($request->query('schedule'));

    $departureDT = \Carbon\Carbon::parse(
        $schedule->departure_date->toDateString().' '.$schedule->departure_time
    );

    if ($departureDT->isPast() || $schedule->status !== 'active') {
        abort(404); // atau redirect back dengan pesan
    }

    return view('public.booking.create', [
        'schedule' => $schedule,
    ]);
}

    public function store(Request $request, SettingService $settings, FonnteService $wa)
    {
        $request->validate([
            'schedule_id' => ['required', 'integer', 'exists:schedules,id'],
            'service_type' => ['required', 'in:regular,carter'],

            'passenger_name' => ['required', 'string', 'max:100'],
            'passenger_id_number' => ['nullable', 'string', 'max:50'],
            'pickup_address' => ['required', 'string', 'max:500'],
            'phone_wa' => ['required', 'string', 'max:30'],
            'notes' => ['nullable', 'string', 'max:1000'],

            'seats_booked' => ['required_if:service_type,regular', 'integer', 'min:1', 'max:6'],
            'end_date' => ['nullable', 'required_if:service_type,carter', 'date'],
        ]);

        $serviceType = $request->service_type;
        $phone = $this->normalizePhone($request->phone_wa);

        // settings
        $driverDailyCost = $settings->getInt('driver_daily_cost', 150000);
        $cancelRegularHours = $settings->getInt('cancellation_regular_hours', 6);
        $cancelCarterDays = $settings->getInt('cancellation_carter_days', 2);

        $prefix = 'ABT-' . now()->format('Ymd') . '-';

        try {
            $booking = DB::transaction(function () use (
                $request,
                $serviceType,
                $phone,
                $driverDailyCost,
                $cancelRegularHours,
                $cancelCarterDays,
                $prefix
            ) {
                // lock schedule di dalam transaksi
                $schedule = Schedule::with('route')
                    ->lockForUpdate()
                    ->findOrFail($request->schedule_id);

                if ($schedule->status !== 'active') {
                    throw new \Exception('Jadwal tidak aktif.');
                }

                $routePrice = (int) $schedule->route->regular_price;

$departureDT = Carbon::parse(
    $schedule->departure_date->toDateString().' '.$schedule->departure_time
);

if ($departureDT->isPast()) {
    throw new \Exception('Jadwal sudah lewat, tidak bisa dibooking.');
}

                // default
                $seatsBooked = 1;
                $totalPrice = 0;
                $cancellationDeadline = null;
                $carterPayload = null;

                if ($serviceType === 'regular') {
                    $seatsBooked = (int) $request->seats_booked;

                    if ($seatsBooked < 1 || $seatsBooked > 6) {
                        throw new \Exception('Jumlah kursi tidak valid.');
                    }

                    // cek kursi cukup
                    if ($seatsBooked > (int)$schedule->available_seats) {
                        throw new \Exception('Kursi tidak mencukupi.');
                    }

                    $totalPrice = $seatsBooked * $routePrice;
                    $cancellationDeadline = (clone $departureDT)->subHours($cancelRegularHours);
                } else {
                    // carter = 6 kursi x tarif + (hari-1) x biaya sopir
                    $endDate = Carbon::parse($request->end_date)->startOfDay();
                    $startDate = Carbon::parse($schedule->departure_date)->startOfDay();

                    if ($endDate->lt($startDate)) {
                        throw new \Exception('Tanggal selesai carter tidak boleh sebelum tanggal berangkat.');
                    }

                    $totalDays = $startDate->diffInDays($endDate) + 1;

                    $base = 6 * $routePrice;
                    $extra = max(0, $totalDays - 1) * (int)$driverDailyCost;

                    $seatsBooked = 6;

                    if ((int)$schedule->available_seats < 6) {
                        throw new \Exception('Jadwal ini tidak bisa dicarter karena kursi tidak penuh tersedia.');
                    }

                    $totalPrice = $base + $extra;
                    $cancellationDeadline = (clone $departureDT)->subDays($cancelCarterDays);

                    $carterPayload = [
                        'end_date' => $endDate->toDateString(),
                        'total_days' => $totalDays,
                        'driver_daily_cost' => (int)$driverDailyCost,
                        'total_cost' => $totalPrice,
                    ];
                }

                // generate kode booking harian
                $todayCount = Booking::where('booking_code', 'like', $prefix . '%')
                    ->lockForUpdate()
                    ->count();

                $seq = str_pad((string)($todayCount + 1), 5, '0', STR_PAD_LEFT);
                $bookingCode = $prefix . $seq;

                // buat booking dulu
                $booking = Booking::create([
                    'booking_code' => $bookingCode,
                    'schedule_id' => $schedule->id,
                    'service_type' => $serviceType,

                    'passenger_name' => $request->passenger_name,
                    'passenger_id_number' => $request->passenger_id_number,
                    'pickup_address' => $request->pickup_address,
                    'phone_wa' => $phone,
                    'notes' => $request->notes,

                    'seats_booked' => $seatsBooked,
                    'total_price' => $totalPrice,

                    'status' => 'pending',
                    'cancellation_deadline' => $cancellationDeadline,
                ]);

                // simpan detail carter
                if ($serviceType === 'carter' && $carterPayload) {
                    CarterDetail::create(array_merge($carterPayload, [
                        'booking_id' => $booking->id,
                    ]));
                }

                // baru kurangi kursi setelah booking berhasil tersimpan
                if ((int)$schedule->available_seats < $seatsBooked) {
                    throw new \Exception('Kursi tidak mencukupi.');
                }

                $schedule->available_seats = (int)$schedule->available_seats - $seatsBooked;
                $schedule->save();

                return $booking;
            });
        } catch (\Exception $e) {
            return back()->withErrors(['booking' => $e->getMessage()])->withInput();
        }

        // kirim WA (kalau gagal, booking tetap sukses)
        $msg = $this->buildWhatsappMessage($booking);
        $sendResult = $wa->send($booking->phone_wa, $msg);
BookingNotification::updateOrCreate(
    [
        'booking_id' => $booking->id,
        'type' => 'booking_confirmation',
    ],
    [
        'target_phone' => $booking->phone_wa,
        'is_success' => (bool)($sendResult['ok'] ?? false),
        'provider' => 'fonnte',
        'provider_message_id' => $sendResult['body']['id'][0] ?? null,
        'provider_response' => $sendResult,
        'sent_at' => now(),
    ]
);
        return redirect()->route('public.booking.success', [
            'code' => $booking->booking_code,
        ])->with('wa_result', $sendResult);
    }

    public function success(Request $request)
    {
        $code = $request->query('code');

        $booking = Booking::with(['schedule.route', 'carterDetail'])
            ->where('booking_code', $code)
            ->firstOrFail();

        $waResult = session('wa_result');

        return view('public.booking.success', [
            'booking' => $booking,
            'waResult' => $waResult,
        ]);
    }

    private function buildWhatsappMessage(Booking $booking): string
    {
        $schedule = $booking->schedule()->with('route')->first();
        $route = $schedule->route;

        $dt = Carbon::parse(
            $schedule->departure_date->toDateString() . ' ' . $schedule->departure_time
        )->format('d-m-Y H:i');

        $lines = [
            "✅ Pemesanan Berhasil - CV Abel Batuah Travel",
            "",
            "Kode Booking: *{$booking->booking_code}*",
            "Nama: {$booking->passenger_name}",
            "Layanan: " . strtoupper($booking->service_type),
            "Rute: {$route->origin_city} → {$route->destination_city}",
            "Jadwal: {$dt}",
            "Alamat Jemput: {$booking->pickup_address}",
            "Total: Rp " . number_format($booking->total_price, 0, ',', '.'),
            "",
            "Cek status / batalkan pesanan dengan kode booking & nomor WA di website.",
        ];

        return implode("\n", $lines);
    }

    private function normalizePhone(string $phone): string
    {
        $phone = preg_replace('/[^0-9]/', '', $phone);
        if (str_starts_with($phone, '0')) {
            $phone = '62' . substr($phone, 1);
        }
        return $phone;
    }
}