<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tweets', function (Blueprint $table) {
            $table->id();
            $table->string('tweet_id');
            $table->unsignedBigInteger('case_id');
            $table->string('tweet_text');
            $table->tinyInteger('status');
            $table->longText('data');
            $table->foreign('case_id')->references('id')->on('help_data');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tweets');
    }
};
