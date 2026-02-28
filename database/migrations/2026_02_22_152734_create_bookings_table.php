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
    Schema::create('bookings', function (Blueprint $table) {
        $table->id();
        $table->string('booking_code')->unique(); // ABT-YYYYMMDD-XXXXX

        $table->foreignId('schedule_id')->constrained()->cascadeOnDelete();
        $table->enum('service_type', ['regular', 'carter']);

        $table->string('passenger_name');
        $table->string('passenger_id_number')->nullable(); // KTP optional
        $table->text('pickup_address');
        $table->string('phone_wa'); // wajib

        $table->text('notes')->nullable();

        // untuk reguler: jumlah kursi yg dipesan
        $table->unsignedTinyInteger('seats_booked')->default(1);

        $table->unsignedInteger('total_price');

        $table->enum('status', ['pending', 'confirmed', 'ongoing', 'completed', 'cancelled'])
              ->default('pending');

        $table->dateTime('cancellation_deadline')->nullable();
        $table->dateTime('cancelled_at')->nullable();

        $table->timestamps();

        $table->index(['schedule_id']);
        $table->index(['booking_code', 'phone_wa']);
        $table->index(['status']);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
