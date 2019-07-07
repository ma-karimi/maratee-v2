<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSeedHubTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('seed_hub', function(Blueprint $table)
		{
			$table->foreign('action_role_id', 'fk_project_has_person_action_role1')->references('id')->on('action_role')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('location_id', 'fk_project_has_person_location1')->references('id')->on('location')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('person_id', 'fk_project_has_person_person1')->references('id')->on('person')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('project_id', 'fk_project_has_person_project1')->references('id')->on('project')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('seed_id', 'fk_project_has_person_seed1')->references('id')->on('seed')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('action_id', 'fk_seed_hub_action1')->references('id')->on('actions')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('seed_hub', function(Blueprint $table)
		{
			$table->dropForeign('fk_project_has_person_action_role1');
			$table->dropForeign('fk_project_has_person_location1');
			$table->dropForeign('fk_project_has_person_person1');
			$table->dropForeign('fk_project_has_person_project1');
			$table->dropForeign('fk_project_has_person_seed1');
			$table->dropForeign('fk_seed_hub_action1');
		});
	}

}
