<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTechnologyCollectionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('technology_collections', function(Blueprint $table)
		{
			$table->foreign('collection_id')->references('id')->on('collections')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('seed_technology_id')->references('id')->on('seed_technologies')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('technology_collections', function(Blueprint $table)
		{
			$table->dropForeign(['collection_id']);
			$table->dropForeign(['seed_technology_id']);
		});
	}

}
