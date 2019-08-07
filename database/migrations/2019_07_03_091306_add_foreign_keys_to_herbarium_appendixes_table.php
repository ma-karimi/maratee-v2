<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToHerbariumAppendixesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('herbarium_appendixes', function(Blueprint $table)
		{
			$table->foreign('herbarium_id')->references('id')->on('herbariums')->onUpdate('NO ACTION')->onDelete('cascade');
			$table->foreign('destination_herbarium_id')->references('id')->on('herbariums')->onUpdate('NO ACTION')->onDelete('cascade');

		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('herbarium_appendixes', function(Blueprint $table)
		{
			$table->dropForeign(['herbarium_id']);
			$table->dropForeign(['destination_herbarium_id']);
		});
	}

}
