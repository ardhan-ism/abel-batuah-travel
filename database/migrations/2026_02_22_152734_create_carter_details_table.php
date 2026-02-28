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
    Schema::create('carter_details', function (Blueprint $table) {
        $table->id();
        $table->foreignId('booking_id')->constrained()->cascadeOnDelete();

        $table->date('end_date')->nullable();
        $table->unsignedInteger('total_days')->default(1);

        $table->unsignedInteger('driver_daily_cost'); // snapshot biaya sopir saat booking
        $table->unsignedInteger('total_cost'); // total carter (opsional: sama dengan bookings.total_price)

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carter_details');
    }
};
