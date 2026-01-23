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
        Schema::create('laboratories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location');
            $table->string('room_number')->nullable();
            $table->integer('capacity')->default(0);
            $table->decimal('area', 10, 2)->nullable();
            $table->enum('status', ['aktif', 'maintenance', 'tidak_aktif'])->default('aktif');
            $table->text('description')->nullable();
            $table->foreignId('head_lab_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('floor_plan_path')->nullable();
            $table->timestamps();
        });

        // Add foreign key for users.laboratory_id
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('laboratory_id')->references('id')->on('laboratories')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['laboratory_id']);
        });
        
        Schema::dropIfExists('laboratories');
    }
};
