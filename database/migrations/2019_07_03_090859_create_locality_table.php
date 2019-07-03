<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLocalityTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('locality', function(Blueprint $table)
		{
		    $table->increments('id');
			$table->integer('paleontology_id')->nullable()->index('fk_locality_paleontology1_idx');
			$table->integer('location_id')->nullable()->index('fk_locality_location1_idx');
			$table->text('formation')->nullable();
			$table->text('layer')->nullable();
			$table->text('stratigraphy')->nullable();
			$table->text('lithology')->nullable();
			$table->text('fauna')->nullable();
			$table->string('description', 45)->nullable();
			$table->integer('map_id')->nullable()->index('fk_locality_map1_idx');

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
		Schema::drop('locality');
	}

}
