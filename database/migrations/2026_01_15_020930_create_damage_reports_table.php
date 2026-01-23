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
        Schema::create('damage_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inventory_item_id')->constrained('inventory_items')->cascadeOnDelete();
            $table->foreignId('reporter_id')->constrained('users')->restrictOnDelete();
            $table->enum('damage_type', ['ringan', 'sedang', 'berat', 'total']);
            $table->text('description');
            $table->string('image_path')->nullable();
            $table->enum('status', ['reported', 'in_progress', 'completed', 'cannot_be_repaired', 'cancelled'])->default('reported');
            $table->decimal('repair_cost', 15, 2)->nullable();
            $table->date('repair_date')->nullable();
            $table->text('repair_notes')->nullable();
            $table->foreignId('repaired_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('damage_reports');
    }
};
