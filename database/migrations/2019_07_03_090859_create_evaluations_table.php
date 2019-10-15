<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEvaluationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('evaluations', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->date('date')->nullable();
			$table->integer('exchange_seeds_no')->nullable();
			$table->integer('planted_seeds_no')->nullable();
			$table->integer('fresh_none_germinated_seeds')->nullable();
			$table->integer('rotten_seeds')->nullable();
			$table->integer('abnormal_seedling')->nullable();
			$table->integer('viability_percentage')->nullable();
			$table->integer('seedling_morality_no')->nullable();
			$table->integer('mean_fresh_seedling_weight')->nullable();
			$table->integer('mean_dry_seedling_weight')->nullable();
			$table->integer('dry_matter_percentage')->nullable();
		    $table->json('description')->nullable();
            $table->timeStamps();
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
		Schema::drop('evaluations');
	}

}
