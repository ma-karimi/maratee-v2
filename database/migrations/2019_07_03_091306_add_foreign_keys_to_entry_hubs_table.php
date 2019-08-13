<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEntryHubsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('entry_hubs', function(Blueprint $table)
		{
			$table->foreign('botanical_id')->references('id')->on('botanicals')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('entry_id')->references('id')->on('entries')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('location_id')->references('id')->on('locations')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('organization_id')->references('id')->on('organizations')->onUpdate('NO ACTION')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('entry_hubs', function(Blueprint $table)
		{
			$table->dropForeign(['botanical_id']);
			$table->dropForeign(['entry_id']);
			$table->dropForeign(['location_id']);
			$table->dropForeign(['organization_id']);
		});
	}

}
