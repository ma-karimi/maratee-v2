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
			$table->foreign('department_id')->references('id')->on('departments')->onUpdate('NO ACTION')->onDelete('cascade');
			$table->foreign('project_id')->references('id')->on('projects')->onUpdate('NO ACTION')->onDelete('cascade');
			$table->foreign('herbarium_id')->references('id')->on('herbariums')->onUpdate('NO ACTION')->onDelete('cascade');
			$table->foreign('action_id')->references('id')->on('actions')->onUpdate('NO ACTION')->onDelete('cascade');
			$table->foreign('location_id')->references('id')->on('locations')->onUpdate('NO ACTION')->onDelete('cascade');
			$table->foreign('user_id')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('cascade');
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
			$table->dropForeign(['user_id']);

		});
	}

}
