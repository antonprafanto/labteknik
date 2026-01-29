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
        Schema::table('borrowing_items', function (Blueprint $table) {
            $table->string('return_photo')->nullable()->after('notes');
            $table->foreignId('returned_by')->nullable()->after('return_photo')->constrained('users')->nullOnDelete();
            $table->enum('return_condition', ['good', 'damaged', 'lost'])->nullable()->after('returned_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('borrowing_items', function (Blueprint $table) {
            $table->dropForeign(['returned_by']);
            $table->dropColumn(['return_photo', 'returned_by', 'return_condition']);
        });
    }
};
