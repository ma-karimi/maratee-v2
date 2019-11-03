<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlantGeographicalsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plant_geographicals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('plant_id');
            $table->unsignedBigInteger('geographical_id');
            $table->foreign('plant_id')->references('id')->on('plants')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('geographical_id')->references('id')->on('geographicals')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->timeStamps();
            $table->softDeletesTz();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('plant_geographicals');
    }

}
