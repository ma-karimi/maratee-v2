<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSeedMolecularsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('seed_moleculars', function(Blueprint $table)
		{
			$table->unsignedInteger('molecular_id');
			$table->unsignedInteger('seed_id');
			$table->unsignedInteger('location_id')->nullable();
			$table->json('treatment');
			$table->integer('repeat');

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
		Schema::drop('seed_moleculars');
	}

}
