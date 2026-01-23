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
        Schema::create('practicum_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('laboratory_id')->constrained('laboratories')->cascadeOnDelete();
            $table->foreignId('lecturer_id')->constrained('users')->restrictOnDelete();
            $table->string('course_name');
            $table->string('class_name', 100);
            $table->date('schedule_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->integer('participants')->default(0);
            $table->enum('status', ['scheduled', 'ongoing', 'completed', 'cancelled'])->default('scheduled');
            $table->text('notes')->nullable();
            $table->foreignId('created_by')->constrained('users')->restrictOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('practicum_schedules');
    }
};
