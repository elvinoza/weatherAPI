<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeathersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weathers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('station_id');
            $table->double('temperature', 5, 2);
            $table->double('humidity', 5, 2);
            $table->double('pressure', 8, 2);
            $table->double('soil_temperature', 5, 2);
            $table->double('soil_humidity', 5, 2);
            $table->double('wind_speed', 6, 2);
            $table->integer('wind_direction');
            $table->double('rain', 5, 2);
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
        Schema::drop('weathers');
    }
}
