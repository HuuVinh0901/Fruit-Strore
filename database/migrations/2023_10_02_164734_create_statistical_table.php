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
        Schema::create('statistical', function (Blueprint $table) {
            $table->increments('statistical_id');
            $table->string('statistical_order_date');
            $table->string('statistical_sell',15);
            $table->string('statistical_cost_buy',15);
            $table->string('statistical_profit',15);
            $table->integer('statistical_product_quantity');
            $table->integer('statistical_order_quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statistical');
    }
};
