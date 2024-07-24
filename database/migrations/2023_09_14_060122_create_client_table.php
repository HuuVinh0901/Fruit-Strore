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
        Schema::create('client', function (Blueprint $table) {
            $table->increments('client_id');
            $table->string('client_name',100);
            $table->string('client_email',100);
            $table->string('client_password');
            $table->string('client_phone',15);
            $table->integer('province_id');
            $table->integer('district_id');
            $table->integer('ward_id');
            $table->string('client_address');
            $table->integer('client_vip');
            $table->string('client_token');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client');
    }
};
