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
			$table->unsignedInteger('soil_id');
			$table->unsignedInteger('soil_id1')->nullable();
			$table->unsignedInteger('lighting_id');
			$table->unsignedInteger('lighting_id1')->nullable();
			$table->unsignedInteger('garden_id')->comment('from garden location
transfer to garden location garden_id1
');
			$table->unsignedInteger('garden_id1')->nullable();
			$table->json('initial_place_type')->nullable();
			$table->json('destination_place_type')->nullable();
			$table->json('initial_place_condition')->nullable();
			$table->json('destination_place_condition')->nullable();
			$table->json('treatment')->nullable();

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
		Schema::drop('botanical_garden_actions');
	}

}
