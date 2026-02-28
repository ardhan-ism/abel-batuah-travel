<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class FonnteService
{
    public function send(string $phone, string $message): array
    {
        $url = config('fonnte.url');
        $token = config('fonnte.token');

        if (!$token) {
            return ['ok' => false, 'error' => 'FONNTE_TOKEN belum di-set'];
        }

        // Fonnte biasanya pakai format 628xxx (tanpa +)
        $phone = preg_replace('/[^0-9]/', '', $phone);
        if (str_starts_with($phone, '0')) {
            $phone = '62' . substr($phone, 1);
        }

        $res = Http::withHeaders([
            'Authorization' => $token,
        ])->asForm()->post($url, [
            'target' => $phone,
            'message' => $message,
        ]);

        return [
            'ok' => $res->successful(),
            'status' => $res->status(),
            'body' => $res->json() ?? $res->body(),
        ];
    }
}