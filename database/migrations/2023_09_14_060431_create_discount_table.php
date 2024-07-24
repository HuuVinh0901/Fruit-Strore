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
        Schema::create('discount', function (Blueprint $table) {
            $table->increments('discount_id');
            $table->string('discount_code',50);
            $table->string('discount_name',100);
            $table->integer('discount_amount');
            $table->integer('discount_category');
            $table->integer('discount_be');
            $table->date('discount_start');
            $table->date('discount_end');
            $table->integer('discount_status');
            $table->string('discount_client');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discount');
    }
};
