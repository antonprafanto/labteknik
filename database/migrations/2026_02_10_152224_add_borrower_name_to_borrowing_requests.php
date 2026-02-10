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
        Schema::table('borrowing_requests', function (Blueprint $table) {
            // Add nullable borrower_name column
            $table->string('borrower_name')->nullable()->after('user_id');
            
            // Make user_id nullable to support manual entries
            $table->foreignId('user_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('borrowing_requests', function (Blueprint $table) {
            // Drop borrower_name column
            $table->dropColumn('borrower_name');
            
            // Make user_id non-nullable again
            $table->foreignId('user_id')->nullable(false)->change();
        });
    }
};
