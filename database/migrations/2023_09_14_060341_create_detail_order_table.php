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
        Schema::create('detail_order', function (Blueprint $table) {
            $table->increments('detail_order_id');
            $table->string('order_code',15);
            $table->integer('product_id');
            $table->string('product_name',100);
            $table->string('product_packing');
            $table->string('product_price',15);
            $table->integer('product_quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_order');
    }
};
