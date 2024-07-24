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
        Schema::create('comment_news', function (Blueprint $table) {
            $table->increments('comment_news_id');
            $table->integer('news_id');
            $table->integer('client_id');
            $table->string('comment_news_detail');
            $table->integer('comment_news_reply');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comment_news');
    }
};
