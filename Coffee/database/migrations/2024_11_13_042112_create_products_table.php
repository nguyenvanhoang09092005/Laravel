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
            $table->string('product_name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->decimal('regular_price', 10, 2);
            $table->decimal('discounted_price', 10, 2)->nullable();
            $table->string('sku')->unique();
            // $table->integer('stock_quantity')->default(0);
            $table->enum('stock_status', ['In Stock', 'Out of Stock'])->default('In Stock');
            $table->decimal('average_rating', 3, 2)->default(0)->comment('Trung bình số sao đánh giá');
            $table->unsignedInteger('review_count')->default(0)->comment('Số lượng đánh giá');
            $table->foreignId('admin_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->foreignId('brand_id')->constrained('brands')->onDelete('cascade');
            $table->foreignId('attribute_id')->nullable()->constrained('attributes')->onDelete('set null');

            $table->string('product_img')->nullable();
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
