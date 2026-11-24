<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations for E-Commerce tables.
     */
    public function up(): void
    {
        // 1. Tabel Produk E-Commerce
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('sku')->unique();
            $table->string('name');
            $table->string('category');
            $table->decimal('price', 14, 2);
            $table->integer('stock')->default(0);
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // 2. Tabel Pesanan / Transaksi E-Commerce
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_code')->unique();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->integer('qty');
            $table->decimal('discount_percent', 5, 2)->default(0);
            $table->decimal('shipping_cost', 12, 2)->default(0);
            $table->decimal('total_price', 14, 2);
            $table->string('status')->default('SUCCESS');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
        Schema::dropIfExists('products');
    }
};
