<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('practicum_schedules', function (Blueprint $table) {
            $table->unsignedTinyInteger('day_of_week')->after('class_name')->nullable();
        });

        // Migrate existing data: format Schedule Date to Day of Week (1 = Monday, 7 = Sunday)
        // MySQL DAYOFWEEK returns 1=Sunday, 2=Monday, ..., 7=Saturday
        // We want 1=Monday (2), 2=Tuesday (3), ... 7=Sunday (1)
        // Formula: (DAYOFWEEK(date) + 5) % 7 + 1
        
        DB::statement("UPDATE practicum_schedules SET day_of_week = (DAYOFWEEK(schedule_date) + 5) % 7 + 1 WHERE schedule_date IS NOT NULL");

        Schema::table('practicum_schedules', function (Blueprint $table) {
            $table->date('schedule_date')->nullable()->change();
            $table->unsignedTinyInteger('day_of_week')->nullable(false)->change(); // Now make it required
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('practicum_schedules', function (Blueprint $table) {
            // We cannot easily revert null dates to non-null without data loss or dummy data
            // For now, just drop the column and make date required again (risky if data was created without date)
            $table->dropColumn('day_of_week');
            $table->date('schedule_date')->nullable(false)->change();
        });
    }
};
