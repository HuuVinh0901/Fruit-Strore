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
        Schema::create('info_order', function (Blueprint $table) {
            $table->increments('info_order_id');
            $table->string('info_order_name',100);
            $table->string('info_order_email',100);
            $table->string('info_order_phone',15);
            $table->integer('province_id');
            $table->integer('district_id');
            $table->integer('ward_id');
            $table->string('info_order_address');
            $table->text('info_order_note');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('info_order');
    }
};
