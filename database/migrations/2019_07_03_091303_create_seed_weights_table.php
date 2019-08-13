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
			$table->integer('total_seed_weight');
			$table->integer('total_fruit_weight')->nullable();
			$table->integer('collected_seeds_no')->nullable();
			$table->json('other_detail')->nullable();
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
