<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiseaseConditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disease_conditions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('disease_model_id');
            $table->integer('clsf_weather_parameter');
            $table->double('start_range', 8, 2)->nullable();
            $table->double('end_range', 8, 2)->nullable();
            $table->double('constant', 8, 2)->nullable();
            $table->boolean('operator')->nullable();
            $table->integer('time');
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
        Schema::drop('disease_conditions');
    }
}
