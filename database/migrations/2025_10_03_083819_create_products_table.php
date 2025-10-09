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
            $table->string('name', 255);
            $table->foreignId('category_id')->constrained('categories');
            $table->foreignId('user_id')->constrained('users');
            $table->decimal('price', 12, 0);
            $table->integer('stock')->default(0);
            $table->integer('sold')->default(0);
            $table->text('description')->nullable();
            $table->enum('status', ['active','inactive','out_of_stock'])->default('active');
            $table->decimal('average_rating', 3, 2)->default(0);
            $table->integer('total_review')->default(0);
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
