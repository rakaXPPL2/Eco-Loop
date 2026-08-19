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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->decimal('weight', 10, 2); // in kg
            $table->integer('stock')->default(1);
            $table->string('image')->nullable();
            $table->enum('condition', ['like_new', 'good', 'fair', 'new'])->default('good');
            $table->enum('status', ['available', 'sold', 'reserved'])->default('available');
            $table->decimal('carbon_saved', 10, 4)->default(0); // calculated from weight * category carbon_value
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
