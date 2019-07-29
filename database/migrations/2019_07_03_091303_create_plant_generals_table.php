<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlantGeneralsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('plant_generals', function(Blueprint $table)
		{
			$table->increments('id');
			$table->json('name');
			$table->json('description')->nullable();
			$table->string('type')->comment('species, sub_species, variety, family, genus, class, group, order, flowering, sperm, cotyledon');
            $table->unsignedInteger('parent_id')->nullable();

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
		Schema::drop('plant_generals');
	}

}
