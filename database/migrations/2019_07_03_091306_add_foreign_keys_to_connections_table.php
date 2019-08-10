<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToConnectionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('connections', function(Blueprint $table)
		{
			$table->foreign('department_id')->references('id')->on('departments')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('location_id')->references('id')->on('locations')->onUpdate('NO ACTION')->onDelete('CASCADE');

		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('connections', function(Blueprint $table)
		{
			$table->dropForeign(['department_id']);

			$table->dropForeign(['location_id']);
		});
	}

}
