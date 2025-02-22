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
        Schema::create('advertise', function (Blueprint $table) {
            $table->increments('advertise_id');
            $table->string('advertise_name',100);
            $table->string('advertise_image');
            $table->text('advertise_detail');
            $table->integer('advertise_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advertise');
    }
};
