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
        Schema::create('money', function (Blueprint $table) {
            $table->increments('money_id');
            $table->string('order_code',15);
            $table->string('money_product',15);
            $table->string('money_discount',15);
            $table->string('delivery_fee',15);
            $table->string('money_total',15);
            $table->integer('status_shipper_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('money');
    }
};
