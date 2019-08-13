<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToBotanicalGardenActionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('botanical_garden_actions', function(Blueprint $table)
		{
			$table->foreign('to_garden_id')->references('id')->on('gardens')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('from_lighting_id')->references('id')->on('lightings')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('to_lighting_id')->references('id')->on('lightings')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('from_soil_id')->references('id')->on('soils')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('to_soil_id')->references('id')->on('soils')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('botanical_id')->references('id')->on('botanicals')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('from_garden_id')->references('id')->on('gardens')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('planting_action_id')->references('id')->on('planting_actions')->onUpdate('NO ACTION')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('botanical_garden_actions', function(Blueprint $table)
		{
			$table->dropForeign(['to_garden_id']);
			$table->dropForeign(['to_lighting_id']);
			$table->dropForeign(['from_lighting_id']);
			$table->dropForeign(['to_soil_id']);
			$table->dropForeign(['from_soil_id']);
			$table->dropForeign(['botanical_id']);
			$table->dropForeign(['from_garden_id']);
			$table->dropForeign(['planting_action_id']);
		});
	}

}
