<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSeedsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('seeds', function(Blueprint $table)
		{
			$table->foreign('department_id')->references('id')->on('departments')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('herbarium_id')->references('id')->on('herbariums')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('protection_id')->references('id')->on('protections')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('seeds', function(Blueprint $table)
		{
			$table->dropForeign(['department_id']);
			$table->dropForeign(['herbarium_id']);
			$table->dropForeign(['protection_id']);
		});
	}

}
