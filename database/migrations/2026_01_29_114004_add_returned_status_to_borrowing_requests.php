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
        // Modify enum to add 'returned' status
        DB::statement("ALTER TABLE borrowing_requests MODIFY COLUMN status ENUM('pending', 'approved_by_laboran', 'approved', 'rejected', 'cancelled', 'completed', 'returned') DEFAULT 'pending'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove 'returned' status (revert to original)
        DB::statement("ALTER TABLE borrowing_requests MODIFY COLUMN status ENUM('pending', 'approved_by_laboran', 'approved', 'rejected', 'cancelled', 'completed') DEFAULT 'pending'");
    }
};
