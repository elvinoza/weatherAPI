<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsValidToFollowDiseaseModelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('follow_disease_model', function (Blueprint $table) {
            $table->boolean('is_valid')->default(true)->after('disease_model_id')	;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('follow_disease_model', function (Blueprint $table) {
            $table->dropColumn('is_valid');
        });
    }
}
