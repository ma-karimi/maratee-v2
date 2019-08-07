<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToGeraminsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('geramins', function(Blueprint $table)
		{
			$table->foreign('collection_id')->references('id')->on('collections')->onUpdate('NO ACTION')->onDelete('cascade');
			$table->foreign('seed_id')->references('id')->on('seeds')->onUpdate('NO ACTION')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('geramins', function(Blueprint $table)
		{
			$table->dropForeign(['collection_id']);
			$table->dropForeign(['seed_id']);
		});
	}

}
