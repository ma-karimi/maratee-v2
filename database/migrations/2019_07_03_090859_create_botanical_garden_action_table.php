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
			$table->unsignedInteger('botanical_id')->nullable()->index('fk_botanical_has_garden_botanical1_idx');
			$table->unsignedInteger('planting_action_id')->nullable()->index('fk_botanical_has_garden_planting_action1_idx');
			$table->date('date')->nullable();
			$table->unsignedInteger('soil_id')->nullable()->index('fk_botanical_garden_action_soil1_idx');
			$table->unsignedInteger('soil_id1')->nullable()->index('fk_botanical_garden_action_soil2_idx');
			$table->unsignedInteger('lighting_id')->nullable()->index('fk_botanical_garden_action_lighting1_idx');
			$table->unsignedInteger('lighting_id1')->nullable()->index('fk_botanical_garden_action_lighting2_idx');
			$table->unsignedInteger('garden_id')->nullable()->index('fk_botanical_has_garden_garden1_idx')->comment('from garden location
transfer to garden location garden_id1
');
			$table->unsignedInteger('garden_id1')->nullable()->index('fk_botanical_garden_action_garden1_idx');
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
