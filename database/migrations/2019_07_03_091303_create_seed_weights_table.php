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
			$table->float('total_seed_weight', 4)->nullable();
			$table->float('total_fruit_weight', 4)->nullable();
			$table->integer('collected_seeds_no')->nullable();
			$table->integer('fruit_mean_seeds_no')->nullable();
			$table->float('thousand_fruit_weight', 4)->nullable();
			$table->float('thousand_seed_weight', 4)->nullable();
			$table->float('regenerated_fruit_weight', 4)->nullable();
			$table->float('regenerated_seed_weight', 4)->nullable();
			$table->float('fruit_weight', 4)->nullable();
			$table->float('seed_weight', 4)->nullable();
			$table->json('other_detail')->nullable();
			$table->string('regeneration_evaluation')->nullable();
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
		Schema::drop('seed_weights');
	}

}
