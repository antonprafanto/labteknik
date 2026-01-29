<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lab_visits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('laboratory_id')->constrained()->cascadeOnDelete();
            
            // Visitor info
            $table->string('visitor_name');
            $table->string('nim_nip');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('study_program')->nullable();
            $table->enum('visitor_type', ['mahasiswa', 'dosen', 'staff', 'tamu'])->default('mahasiswa');
            
            // Visit details
            $table->text('purpose');
            $table->string('activity')->nullable(); // praktikum, penelitian, belajar mandiri, dll
            $table->dateTime('check_in_time');
            $table->dateTime('check_out_time')->nullable();
            $table->integer('duration_minutes')->nullable(); // Auto-calculated on check-out
            
            $table->text('notes')->nullable();
            $table->foreignId('verified_by')->nullable()->constrained('users')->nullOnDelete();
            
            $table->timestamps();

            // Indexes for reporting
            $table->index(['laboratory_id', 'check_in_time']);
            $table->index(['nim_nip', 'check_in_time']);
            $table->index('visitor_type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lab_visits');
    }
};
