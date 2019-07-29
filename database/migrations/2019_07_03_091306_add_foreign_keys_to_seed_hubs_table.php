<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSeedHubsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('seed_hubs', function(Blueprint $table)
		{
			$table->foreign('location_id')->references('id')->on('locations')->onUpdate('NO ACTION')->onDelete('NO ACTION');

			$table->foreign('project_id')->references('id')->on('projects')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('user_id')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('seed_id')->references('id')->on('seeds')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('action_id')->references('id')->on('actions')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('seed_hubs', function(Blueprint $table)
		{
			$table->dropForeign(['location_id']);

			$table->dropForeign(['user_id']);
			$table->dropForeign(['project_id']);
			$table->dropForeign(['seed_id']);
			$table->dropForeign(['action_id']);
		});
	}

}
