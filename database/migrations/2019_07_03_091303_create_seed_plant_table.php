<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSeedPlantTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('seed_plant', function(Blueprint $table)
		{
		    $table->increments('id');
			$table->integer('seed_id')->index('fk_seed_plant_seed1_idx');
			$table->integer('plant_id')->index('fk_seed_plant_plant1_idx');
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
		Schema::drop('seed_plant');
	}

}
