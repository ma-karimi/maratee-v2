<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToBotanicalGardenActionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('botanical_garden_action', function(Blueprint $table)
		{
			$table->foreign('garden_id1', 'fk_botanical_garden_action_garden1')->references('id')->on('garden')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('lighting_id', 'fk_botanical_garden_action_lighting1')->references('id')->on('lighting')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('lighting_id1', 'fk_botanical_garden_action_lighting2')->references('id')->on('lighting')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('soil_id', 'fk_botanical_garden_action_soil1')->references('id')->on('soil')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('soil_id1', 'fk_botanical_garden_action_soil2')->references('id')->on('soil')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('botanical_id', 'fk_botanical_has_garden_botanical1')->references('id')->on('botanical')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('garden_id', 'fk_botanical_has_garden_garden1')->references('id')->on('garden')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('planting_action_id', 'fk_botanical_has_garden_planting_action1')->references('id')->on('planting_action')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('botanical_garden_action', function(Blueprint $table)
		{
			$table->dropForeign('fk_botanical_garden_action_garden1');
			$table->dropForeign('fk_botanical_garden_action_lighting1');
			$table->dropForeign('fk_botanical_garden_action_lighting2');
			$table->dropForeign('fk_botanical_garden_action_soil1');
			$table->dropForeign('fk_botanical_garden_action_soil2');
			$table->dropForeign('fk_botanical_has_garden_botanical1');
			$table->dropForeign('fk_botanical_has_garden_garden1');
			$table->dropForeign('fk_botanical_has_garden_planting_action1');
		});
	}

}
