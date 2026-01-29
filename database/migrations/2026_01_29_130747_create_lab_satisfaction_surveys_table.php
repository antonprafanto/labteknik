<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lab_satisfaction_surveys', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('laboratory_id')->constrained()->cascadeOnDelete();
            $table->foreignId('borrowing_request_id')->nullable()->constrained()->nullOnDelete();
            $table->unsignedBigInteger('room_borrowing_id')->nullable();
            $table->string('survey_token', 64)->unique();
            $table->boolean('is_anonymous')->default(false);
            
            // Ratings 1-5
            $table->tinyInteger('rating_cleanliness')->unsigned()->nullable(); // Kebersihan
            $table->tinyInteger('rating_service')->unsigned()->nullable();     // Pelayanan
            $table->tinyInteger('rating_facilities')->unsigned()->nullable();  // Fasilitas
            $table->tinyInteger('rating_equipment')->unsigned()->nullable();   // Peralatan
            $table->tinyInteger('rating_comfort')->unsigned()->nullable();     // Kenyamanan
            $table->tinyInteger('rating_safety')->unsigned()->nullable();      // Keamanan
            $table->tinyInteger('rating_overall')->unsigned()->nullable();     // Keseluruhan
            
            $table->text('suggestions')->nullable(); // Kritik & saran
            $table->timestamps();

            $table->foreign('room_borrowing_id')->references('id')->on('room_borrowings')->nullOnDelete();
            $table->index(['laboratory_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lab_satisfaction_surveys');
    }
};
