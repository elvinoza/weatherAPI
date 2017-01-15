<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('station_id');
            $table->integer('clsf_weather_parameter');
            $table->integer('compare_operator');
            $table->double('value', 8, 2);
            $table->boolean('is_active');
            $table->boolean('is_valid');
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
        Schema::drop('notifications_settings');
    }
}
