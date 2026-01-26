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
        Schema::create('time_slots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('laboratory_id')->nullable()->constrained()->cascadeOnDelete();
            $table->time('start_time');
            $table->time('end_time');
            $table->boolean('is_friday')->default(false); // Slot khusus Jumat
            $table->boolean('is_break')->default(false); // Istirahat (sholat Jumat)
            $table->string('break_label')->nullable(); // Label istirahat
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index(['laboratory_id', 'is_friday', 'sort_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('time_slots');
    }
};
