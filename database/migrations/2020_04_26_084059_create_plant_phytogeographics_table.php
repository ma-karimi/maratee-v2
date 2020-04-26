<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlantPhytogeographicsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plant_phytogeographics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('plant_id');
            $table->unsignedBigInteger('general_id');
            $table->timeStamps();
            $table->softDeletesTz();
            $table->foreign('plant_id')->references('id')->on('plants')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('general_id')->references('id')->on('generals')->onUpdate('NO ACTION')->onDelete('CASCADE');

        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('plant_phytogeographics');
    }

}
