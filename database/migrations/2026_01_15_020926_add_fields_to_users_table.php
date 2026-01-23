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
        Schema::table('users', function (Blueprint $table) {
            // Using string for role instead of enum to avoid strict mode issues and length constraints
            $table->string('role', 50)->after('email')->default('student');
            $table->string('nip_nim', 50)->unique()->nullable()->after('role');
            $table->string('phone', 20)->nullable()->after('nip_nim');
            $table->string('study_program', 100)->nullable()->after('phone');
            $table->string('avatar_path', 255)->nullable()->after('study_program');
            $table->boolean('is_active')->default(true)->after('avatar_path');
            $table->unsignedBigInteger('laboratory_id')->nullable()->after('is_active');
            // Foreign key constraint will be added in create_laboratories_table migration
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'nip_nim', 'phone', 'study_program', 'avatar_path', 'is_active', 'laboratory_id']);
        });
    }
};
