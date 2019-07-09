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
			$table->foreign('to_garden_id')->references('id')->on('gardens')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('from_lighting_id')->references('id')->on('lightings')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('to_lighting_id')->references('id')->on('lightings')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('from_soil_id')->references('id')->on('soils')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('to_soil_id')->references('id')->on('soils')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('botanical_id')->references('id')->on('botanicals')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('from_garden_id')->references('id')->on('gardens')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('planting_action_id')->references('id')->on('planting_actions')->onUpdate('NO ACTION')->onDelete('NO ACTION');
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
			$table->dropForeign(['garden_id1']);
			$table->dropForeign(['lighting_id']);
			$table->dropForeign(['lighting_id1']);
			$table->dropForeign(['soil_id']);
			$table->dropForeign(['soil_id1']);
			$table->dropForeign(['botanical_id']);
			$table->dropForeign(['garden_id']);
			$table->dropForeign(['planting_action_id']);
		});
	}

}
