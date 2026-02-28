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
    Schema::table('schedules', function (Blueprint $table) {
        $table->enum('departure_decision', ['pending','go','cancel'])
              ->default('pending')
              ->after('status');
        $table->text('decision_note')->nullable()->after('departure_decision');
        $table->timestamp('decided_at')->nullable()->after('decision_note');
    });
}

public function down(): void
{
    Schema::table('schedules', function (Blueprint $table) {
        $table->dropColumn(['departure_decision','decision_note','decided_at']);
    });
}
};
