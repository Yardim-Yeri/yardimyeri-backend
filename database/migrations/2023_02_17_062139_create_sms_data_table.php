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
        Schema::create('sms_data', function (Blueprint $table) {
            $table->id();
            $table->string('phone');
            $table->string('message');
            $table->tinyInteger('status');
            $table->longText('response');
            $table->unsignedBigInteger('case_id');
            $table->foreign('case_id')->references('id')->on('help_data');
            $table->longText('data');
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
        Schema::dropIfExists('sms_data');
    }
};
