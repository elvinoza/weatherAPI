<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDataForForecastTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_for_forecast', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('station_id');
            $table->double('temperature', 5, 2);
            $table->double('pressure', 8, 2);
            $table->double('wind_speed', 6, 2)->nullable();
            $table->integer('wind_direction')->nullable();
            $table->integer('phenomena')->nullable();
            $table->date('date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('data_for_forecast');
    }
}