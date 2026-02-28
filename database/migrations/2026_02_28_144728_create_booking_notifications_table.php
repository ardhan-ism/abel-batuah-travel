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
    Schema::create('booking_notifications', function (Blueprint $table) {
        $table->id();
        $table->foreignId('booking_id')->constrained()->cascadeOnDelete();
        $table->string('type'); // contoh: reminder_6h
        $table->string('target_phone')->nullable();
        $table->boolean('is_success')->default(false);
        $table->string('provider')->default('fonnte');
        $table->string('provider_message_id')->nullable();
        $table->json('provider_response')->nullable();
        $table->timestamp('sent_at')->nullable();
        $table->timestamps();

        $table->unique(['booking_id', 'type']); // anti dobel
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_notifications');
    }
};
