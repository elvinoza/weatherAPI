<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateForecastTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('forecast', function (Blueprint $table) {
            $table->dropColumn('soil_temperature');
            $table->dropColumn('soil_humidity');
            $table->dropColumn('humidity');
            $table->dropColumn('rain');
            $table->integer('phenomena')->after('wind_direction')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('forecast', function (Blueprint $table) {
            $table->double('soil_temperature', 5, 2);
            $table->double('soil_humidity', 5, 2);
            $table->double('humidity', 5, 2);
            $table->double('rain', 5, 2);
            $table->dropColumn('phenomena');
        });
    }
}
