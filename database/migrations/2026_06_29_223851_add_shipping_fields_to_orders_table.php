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
        Schema::table('orders', function (Blueprint $table) {

            // Customer's full name
            $table->string('shipping_name')->nullable();

            // Street address
            $table->string('shipping_address')->nullable();

            // City
            $table->string('shipping_city')->nullable();

            // State
            $table->string('shipping_state')->nullable();

            // ZIP code
            $table->string('shipping_zip')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {

            $table->dropColumn([
                'shipping_name',
                'shipping_address',
                'shipping_city',
                'shipping_state',
                'shipping_zip',
            ]);

        });
    }
};