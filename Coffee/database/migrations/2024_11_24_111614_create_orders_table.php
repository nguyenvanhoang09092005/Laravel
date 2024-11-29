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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->unsignedBigInteger('promotion_id')->nullable()->index();
            $table->foreign('promotion_id')->references('id')->on('promotions')->onDelete('set null');
            $table->unsignedBigInteger('shipping_address_id');
            $table->foreignId('shipping_address_id')->constrained('shipping_addresses')->onDelete('cascade');
            $table->string('order_code')->unique()->nullable();
            $table->decimal('total_price_without_discount', 10, 2);
            $table->decimal('total_price', 10, 2);
            $table->decimal('total_discount', 10, 2)->nullable();
            $table->integer('items_count')->default(0);
            $table->string('payment_method')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
