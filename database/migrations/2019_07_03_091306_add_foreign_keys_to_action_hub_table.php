<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToActionHubsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('action_hubs', function(Blueprint $table)
		{
			$table->foreign('department_id')->references('id')->on('department')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('project_id')->references('id')->on('project')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('herbarium_id')->references('id')->on('herbarium')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('action_id')->references('id')->on('actions')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('location_id')->references('id')->on('location')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('person_id')->references('id')->on('person')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('action_hubs', function(Blueprint $table)
		{
			$table->dropForeign(['department_id']);
			$table->dropForeign(['project_id']);
			$table->dropForeign(['herbarium_id']);
			$table->dropForeign(['action_id']);
			$table->dropForeign(['location_id']);
			$table->dropForeign(['person_id']);
		});
	}

}
