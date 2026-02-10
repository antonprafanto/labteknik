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
        // Step 1: Add new lecturer_name column (nullable for now)
        Schema::table('practicum_schedules', function (Blueprint $table) {
            $table->string('lecturer_name')->nullable()->after('laboratory_id');
        });

        // Step 2: Migrate data from lecturer relationship to lecturer_name
        DB::statement("
            UPDATE practicum_schedules ps
            INNER JOIN users u ON ps.lecturer_id = u.id
            SET ps.lecturer_name = u.name
        ");

        // Step 3: Drop foreign key constraint and lecturer_id column
        Schema::table('practicum_schedules', function (Blueprint $table) {
            $table->dropForeign(['lecturer_id']);
            $table->dropColumn('lecturer_id');
        });

        // Step 4: Make lecturer_name non-nullable now that data is migrated
        Schema::table('practicum_schedules', function (Blueprint $table) {
            $table->string('lecturer_name')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Step 1: Add back lecturer_id column
        Schema::table('practicum_schedules', function (Blueprint $table) {
            $table->foreignId('lecturer_id')->nullable()->after('laboratory_id')->constrained('users')->restrictOnDelete();
        });

        // Step 2: Try to restore relationships (best effort - may not be perfect)
        DB::statement("
            UPDATE practicum_schedules ps
            INNER JOIN users u ON ps.lecturer_name = u.name
            SET ps.lecturer_id = u.id
            WHERE ps.lecturer_name IS NOT NULL
        ");

        // Step 3: Drop lecturer_name column
        Schema::table('practicum_schedules', function (Blueprint $table) {
            $table->dropColumn('lecturer_name');
        });
    }
};
