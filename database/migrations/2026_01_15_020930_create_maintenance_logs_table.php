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
        Schema::create('maintenance_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inventory_item_id')->constrained('inventory_items')->cascadeOnDelete();
            $table->foreignId('technician_id')->constrained('users')->restrictOnDelete();
            $table->date('maintenance_date');
            $table->enum('maintenance_type', ['routine', 'calibration', 'repair', 'replacement']);
            $table->text('description');
            $table->decimal('cost', 15, 2)->nullable();
            $table->string('document_path')->nullable();
            $table->date('next_maintenance_date')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance_logs');
    }
};
