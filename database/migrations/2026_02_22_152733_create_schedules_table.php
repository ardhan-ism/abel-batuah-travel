<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up(): void
{
    Schema::create('schedules', function (Blueprint $table) {
        $table->id();
        $table->foreignId('route_id')->constrained()->cascadeOnDelete();
        $table->foreignId('driver_id')->nullable()->constrained()->nullOnDelete();

        $table->date('departure_date');
        $table->time('departure_time');

        $table->unsignedTinyInteger('total_seats')->default(6);
        $table->unsignedTinyInteger('available_seats')->default(6);

        $table->enum('status', ['active', 'cancelled'])->default('active');

        // Opsional: minimal penumpang berangkat
        $table->unsignedTinyInteger('min_passengers')->default(1);

        $table->timestamps();

        // Untuk mempercepat pencarian jadwal & cek bentrok driver
        $table->index(['route_id', 'departure_date', 'departure_time']);
        $table->index(['driver_id', 'departure_date', 'departure_time']);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
