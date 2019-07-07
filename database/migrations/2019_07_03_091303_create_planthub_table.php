<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlanthubTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('planthub', function(Blueprint $table)
		{
			$table->increments('id');
			$table->unsignedInteger('plantsubspecies_id')->nullable();
			$table->unsignedInteger('plantvariety_id')->nullable();
			$table->unsignedInteger('plantspecies_id')->nullable();
			$table->unsignedInteger('plantfamily_id');
			$table->unsignedInteger('plantgenus_id');
			$table->unsignedInteger('plant_id');
			$table->unsignedInteger('person_id')->nullable();
            $table->unsignedInteger('creator_id');

            $table->unsignedInteger('article_id')->nullable();
			$table->unsignedInteger('plantclass_id')->nullable();
			$table->unsignedInteger('author_id')->nullable();
			$table->unsignedInteger('location_id')->nullable();
			$table->unsignedInteger('protection_id')->nullable();
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
		Schema::drop('planthub');
	}

}
