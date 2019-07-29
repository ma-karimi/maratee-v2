<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPaleontologyActionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('paleontology_actions', function(Blueprint $table)
		{
			$table->foreign('user_id')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('action_id')->references('id')->on('actions')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('paleontology_id')->references('id')->on('paleontologies')->onUpdate('NO ACTION')->onDelete('NO ACTION');

		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('paleontology_actions', function(Blueprint $table)
		{
			$table->dropForeign(['user_id']);
			$table->dropForeign(['action_id']);
			$table->dropForeign(['paleontology_id']);

		});
	}

}
