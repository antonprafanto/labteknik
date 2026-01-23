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
        Schema::create('inventory_items', function (Blueprint $table) {
            $table->id();
            $table->string('code', 100)->unique();
            $table->string('name');
            $table->string('brand', 100)->nullable();
            $table->string('model', 100)->nullable();
            $table->text('description')->nullable();
            $table->year('purchase_year')->nullable();
            $table->enum('condition', ['good', 'fair', 'poor', 'damaged'])->default('good');
            $table->enum('status', ['available', 'borrowed', 'maintenance', 'damaged', 'lost'])->default('available');
            $table->integer('quantity')->default(1);
            $table->integer('available_quantity')->default(1);
            $table->foreignId('laboratory_id')->constrained('laboratories')->cascadeOnDelete();
            $table->foreignId('category_id')->constrained('inventory_categories')->restrictOnDelete();
            $table->decimal('price', 15, 2)->nullable();
            $table->string('image_path')->nullable();
            $table->string('barcode_path')->nullable();
            $table->integer('minimum_stock')->default(0);
            $table->json('specifications')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_items');
    }
};
