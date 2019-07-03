<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBotanicalGardenActionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('botanical_garden_action', function(Blueprint $table)
		{
		    $table->increments('id');
			$table->integer('botanical_id')->nullable()->index('fk_botanical_has_garden_botanical1_idx');
			$table->integer('planting_action_id')->nullable()->index('fk_botanical_has_garden_planting_action1_idx');
			$table->date('date')->nullable();
			$table->integer('soil_id')->nullable()->index('fk_botanical_garden_action_soil1_idx');
			$table->integer('soil_id1')->nullable()->index('fk_botanical_garden_action_soil2_idx');
			$table->integer('lighting_id')->nullable()->index('fk_botanical_garden_action_lighting1_idx');
			$table->integer('lighting_id1')->nullable()->index('fk_botanical_garden_action_lighting2_idx');
			$table->integer('garden_id')->nullable()->index('fk_botanical_has_garden_garden1_idx')->comment('from garden location
transfer to garden location garden_id1
');
			$table->integer('garden_id1')->nullable()->index('fk_botanical_garden_action_garden1_idx');
			$table->text('initial_place_type')->nullable();
			$table->text('destination_place_type')->nullable();
			$table->text('initial_place_condition')->nullable();
			$table->text('destination_place_condition')->nullable();
			$table->text('treatment')->nullable();

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
		Schema::drop('botanical_garden_action');
	}

}
