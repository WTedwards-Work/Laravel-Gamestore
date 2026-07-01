<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();

            // Connects this item to one cart.
            $table->foreignId('cart_id')->constrained()->onDelete('cascade');

            // Connects this cart item to one product.
            $table->foreignId('product_id')->constrained()->onDelete('cascade');

            // Stores how many of that product are in the cart.
            $table->integer('quantity')->default(1);

            $table->timestamps();

            // Prevents the same product from being added twice as separate rows.
            $table->unique(['cart_id', 'product_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};