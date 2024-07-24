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
        Schema::create('comment_product', function (Blueprint $table) {
            $table->increments('comment_product_id');
            $table->integer('product_id');
            $table->integer('client_id');
            $table->string('comment_product_detail');
            $table->integer('comment_product_reply');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comment_product');
    }
};
