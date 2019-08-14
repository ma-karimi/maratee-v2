<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBotanicalGardenActionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('botanical_garden_actions', function(Blueprint $table)
		{
			$table->unsignedInteger('botanical_id');
			$table->unsignedInteger('planting_action_id');
			$table->date('date')->nullable();
			$table->unsignedInteger('from_soil_id');
			$table->unsignedInteger('to_soil_id')->nullable();
			$table->unsignedInteger('from_lighting_id');
			$table->unsignedInteger('to_lighting_id')->nullable();
			$table->unsignedInteger('from_garden_id')->comment('from garden location
transfer to garden location garden_id1
');
			$table->unsignedInteger('to_garden_id')->nullable();
			$table->json('initial_place_type')->nullable();
			$table->json('destination_place_type')->nullable();
			$table->json('initial_place_condition')->nullable();
			$table->json('destination_place_condition')->nullable();
			$table->json('treatment')->nullable();


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
		Schema::drop('botanical_garden_actions');
	}

}
