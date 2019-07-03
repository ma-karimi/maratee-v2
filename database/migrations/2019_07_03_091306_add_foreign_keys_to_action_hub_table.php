<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToActionHubTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('action_hub', function(Blueprint $table)
		{
			$table->foreign('department_id', 'fk_action_hub_department1')->references('id')->on('department')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('project_id', 'fk_action_hub_project1')->references('id')->on('project')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('herbarium_id', 'fk_action_relations_herbarium1')->references('id')->on('herbarium')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('action_id', 'fk_person_has_action_action1')->references('id')->on('action')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('location_id', 'fk_person_has_action_location1')->references('id')->on('location')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('person_id', 'fk_person_has_action_person1')->references('id')->on('person')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('action_hub', function(Blueprint $table)
		{
			$table->dropForeign('fk_action_hub_department1');
			$table->dropForeign('fk_action_hub_project1');
			$table->dropForeign('fk_action_relations_herbarium1');
			$table->dropForeign('fk_person_has_action_action1');
			$table->dropForeign('fk_person_has_action_location1');
			$table->dropForeign('fk_person_has_action_person1');
		});
	}

}
