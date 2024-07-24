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
        Schema::create('product', function (Blueprint $table) {
            $table->increments('product_id');
            $table->integer('category_product_id');
            $table->integer('origin_id');
            $table->string('product_name',100);
            $table->string('product_image');
            $table->text('product_summary');
            $table->text('product_tag');
            $table->text('product_detail');
            $table->string('product_packing');
            $table->int('product_price',15);
            $table->int('product_sale',15);
            $table->integer('product_amount');
            $table->integer('product_sold');
            $table->integer('product_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
