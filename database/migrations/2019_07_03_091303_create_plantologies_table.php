<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlantologiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('plantologies', function(Blueprint $table)
		{
			$table->increments('id');
			$table->json('name');
			$table->json('description')->nullable();
			$table->string('type')->comment('phytogeography, phenology, plant_type');

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
		Schema::drop('plantologies');
	}

}
