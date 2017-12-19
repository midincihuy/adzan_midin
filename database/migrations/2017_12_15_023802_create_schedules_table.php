<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->increments('id');
            $table->string('city_id');
            $table->string('tanggal');
            $table->string('imsyak');
            $table->string('shubuh');
            $table->string('terbit');
            $table->string('dhuha');
            $table->string('dzuhur');
            $table->string('ashr');
            $table->string('maghrib');
            $table->string('isya');
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
        Schema::dropIfExists('schedules');
    }
}
