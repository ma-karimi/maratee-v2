<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBotanicalTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('botanical', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('herbarium_id')->index('fk_garden_herbarium1_idx');
			$table->integer('height')->nullable();
			$table->text('flower_color')->nullable();
			$table->text('fruit_color')->nullable();
			$table->text('leaf_color')->nullable();
			$table->text('sprout')->nullable();
			$table->text('treatment')->nullable();
			$table->text('growth_rate')->nullable();
			$table->text('first_flowering')->nullable();
			$table->text('flowring_interval')->nullable()->comment('based on the number of days
');
			$table->text('first_seeding')->nullable();
			$table->text('seed_value')->nullable();
			$table->text('seed_production')->nullable();
			$table->text('season_resistance')->nullable();
			$table->date('year')->nullable();
			$table->text('sensitivity')->nullable();
			$table->text('sensitivity_description')->nullable();
			$table->text('notes')->nullable();
			$table->date('planting')->nullable();
			$table->integer('scion_rooting_per')->nullable();
			$table->text('entry_type')->nullable();

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
		Schema::drop('botanical');
	}

}
