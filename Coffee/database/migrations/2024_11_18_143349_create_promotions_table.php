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
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->enum('type', ['percentage', 'fixed'])->default('percentage');
            $table->string('promotion_img')->nullable();
            $table->decimal('discount', 8, 2);
            $table->string('sku', 50)->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->enum('status', ['In Stock', 'Out of Stock'])->default('In Stock');
            $table->date('expiry_date')->nullable();
            $table->timestamps();


            $table->foreign('sku')->references('sku')->on('products')->onDelete('set null');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};
