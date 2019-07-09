<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLocalitiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('localities', function(Blueprint $table)
		{
		    $table->increments('id');
			$table->unsignedInteger('paleontology_id');
			$table->unsignedInteger('location_id');
			$table->json('formation')->nullable();
			$table->json('layer')->nullable();
			$table->json('stratigraphy')->nullable();
			$table->json('lithology')->nullable();
			$table->json('fauna')->nullable();
			$table->json('description')->nullable();
			$table->unsignedInteger('map_id')->nullable();


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
		Schema::drop('localities');
	}

}
