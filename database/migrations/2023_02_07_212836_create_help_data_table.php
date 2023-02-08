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
        Schema::create('help_data', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('tel')->nullable();
            $table->string('ihtiyac_turu');
            $table->text('ihtiyac_turu_detayi')->nullable();
            $table->integer('kac_kisilik');
            $table->string('sehir');
            $table->integer('ilce_id');
            $table->integer('mahalle_id');
            $table->integer('sokak_id')->nullable();
            $table->string('apartman')->nullable();
            $table->text('adres_tarifi')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->enum('help_status', ['Yardım Bekliyor', 'Yardım Geliyor', 'Yardım Ulaştı']);
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
        Schema::dropIfExists('help_data');
    }
};
