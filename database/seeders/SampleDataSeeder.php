<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Route;
use App\Models\Driver;
use App\Models\Schedule;

class SampleDataSeeder extends Seeder
{
    public function run(): void
    {
        $driver1 = Driver::updateOrCreate(
            ['name' => 'Sopir A'],
            ['phone' => '628111111111', 'status' => 'available']
        );

        $route1 = Route::updateOrCreate(
            ['origin_city' => 'Banjarmasin', 'destination_city' => 'Banjarbaru'],
            ['regular_price' => 100000]
        );

        // sample jadwal untuk besok jam 09:00
        $date = now()->addDay()->toDateString();

        Schedule::updateOrCreate(
            [
                'route_id' => $route1->id,
                'departure_date' => $date,
                'departure_time' => '09:00:00',
            ],
            [
                'driver_id' => $driver1->id,
                'total_seats' => 6,
                'available_seats' => 6,
                'status' => 'active',
                'min_passengers' => 3,
            ]
        );
    }
}