<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSeedWeightTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('seed_weight', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('seed_technology_id')->index('fk_seed_weight_seed_technology1_idx');
			$table->integer('total')->nullable();
			$table->integer('active')->nullable();
			$table->integer('base')->nullable();
			$table->integer('support')->nullable();
			$table->integer('base_revival')->nullable();
			$table->integer('active_revival')->nullable();
			$table->integer('support_revival')->nullable();
			$table->string('revival_code', 45)->nullable();
			$table->text('description')->nullable();
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
		Schema::drop('seed_weight');
	}

}
