<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSeedWeightsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('seed_weights', function(Blueprint $table)
		{
			$table->increments('id');
			$table->unsignedInteger('seed_technology_id');
			$table->integer('total');
			$table->integer('active')->nullable();
			$table->integer('base')->nullable();
			$table->integer('support')->nullable();
			$table->integer('base_revival')->nullable();
			$table->integer('active_revival')->nullable();
			$table->integer('support_revival')->nullable();
			$table->string('revival_code', 45)->nullable();
			$table->json('description')->nullable();
            $table->unsignedInteger('person_id');
			$table->unsignedInteger('creator_id');
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
		Schema::drop('seed_weights');
	}

}
