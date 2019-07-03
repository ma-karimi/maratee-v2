<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlantsubspeciesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('plantsubspecies', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('name')->nullable();
			$table->text('description')->nullable();
			$table->integer('Author_id')->nullable()->index('fk_plantsubspecies_Author1_idx');
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
		Schema::drop('plantsubspecies');
	}

}
