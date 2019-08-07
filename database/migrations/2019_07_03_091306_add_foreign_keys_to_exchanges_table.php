<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToExchangesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('exchanges', function(Blueprint $table)
		{
			$table->foreign('send_herbarium_id')->references('id')->on('herbariums')->onUpdate('NO ACTION')->onDelete('cascade');
			$table->foreign('receive_herbarium_id')->references('id')->on('herbariums')->onUpdate('NO ACTION')->onDelete('cascade');
			$table->foreign('send_paleontology_id')->references('id')->on('paleontologies')->onUpdate('NO ACTION')->onDelete('cascade');
			$table->foreign('receive_paleontology_id')->references('id')->on('paleontologies')->onUpdate('NO ACTION')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('exchanges', function(Blueprint $table)
		{
			$table->dropForeign(['send_herbarium_id']);
			$table->dropForeign(['receive_herbarium_id']);
			$table->dropForeign(['send_paleontology_id']);
			$table->dropForeign(['receive_paleontology_id']);
		});
	}

}
