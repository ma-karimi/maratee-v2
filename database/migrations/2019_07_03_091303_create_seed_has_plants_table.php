<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSeedHasPlantsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seed_has_plants', function (Blueprint $table) {
            $table->unsignedBigInteger('seed_id');
            $table->unsignedBigInteger('plant_herbarium_id');

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
        Schema::drop('seed_has_plants');
    }

}
