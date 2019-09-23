<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlantPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plant_properties', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('plant_herbarium_id');
            $table->unsignedBigInteger('general_id');
            $table->timestamps();
            $table->softDeletesTz();
            $table->foreign('plant_herbarium_id')->references('id')->on('plant_herbariums')->onUpdate('NO ACTION')->onDelete('CASCADE');
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

        Schema::dropIfExists('plant_properties');
    }
}
