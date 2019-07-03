<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSeedHasPlantTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seed_has_plant', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('seed_id')->index('fk_seed_has_plant_seed1_idx');
            $table->unsignedInteger('plant_id')->index('fk_seed_has_plant_plant1_idx');
//            $table->primary(['seed_id', 'plant_id']);
            $table->integer('person_id');
            $table->tinyInteger('status_id')->default(0);
            $table->timeStampsTz();
            $table->dateTimeTz('deleted_at')->nullable();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('seed_has_plant');
    }

}
