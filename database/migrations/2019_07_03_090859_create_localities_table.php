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
		    $table->bigIncrements('id');
			$table->unsignedBigInteger('paleontology_id');
			$table->unsignedBigInteger('location_id');
			$table->json('formation')->nullable();
			$table->json('layer')->nullable();
			$table->json('stratigraphy')->nullable();
			$table->json('lithology')->nullable();
			$table->json('fauna')->nullable();
			$table->json('description')->nullable();
			$table->unsignedBigInteger('map_id')->nullable();


            $table->timeStampsTz();
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
		Schema::drop('localities');
	}

}
