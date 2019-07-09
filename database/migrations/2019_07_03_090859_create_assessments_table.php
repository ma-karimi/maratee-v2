<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAssessmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('assessments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->date('date')->nullable();
			$table->integer('seed_qt')->nullable();
			$table->integer('weight_k');
			$table->integer('purity')->nullable();
			$table->integer('hollow')->nullable();
			$table->integer('dropped')->nullable();
			$table->integer('repeat')->nullable();
			$table->json('treatment')->nullable();
			$table->integer('abnormality')->nullable();
			$table->integer('hard_seed')->nullable();
			$table->integer('vigor')->nullable();
			$table->integer('losses')->nullable();
			$table->integer('sprout')->nullable();
			$table->integer('sprout_rate')->nullable();
			$table->integer('sprout_index')->nullable();
			$table->integer('vigor_index')->nullable();
			$table->integer('root_length')->nullable();
			$table->integer('stem_length')->nullable();
			$table->integer('seedling_length')->nullable();
			$table->integer('root_stem_rate')->nullable();
			$table->integer('wet_uint_weight')->nullable();
			$table->integer('dry_unit_weight')->nullable();
			$table->integer('dry_material_rate')->nullable();
			$table->integer('seed_length')->nullable();
			$table->integer('seed_width')->nullable();
			$table->json('description')->nullable();


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
		Schema::drop('assessments');
	}

}
