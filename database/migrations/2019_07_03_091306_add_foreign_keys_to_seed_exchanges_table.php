<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSeedExchangesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('seed_exchanges', function(Blueprint $table)
		{
			$table->foreign('collection_id')->references('id')->on('collections')->onUpdate('NO ACTION')->onDelete('CASCADE');

			$table->foreign('seed_id')->references('id')->on('seeds')->onUpdate('NO ACTION')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('seed_exchanges', function(Blueprint $table)
		{
			$table->dropForeign(['collection_id']);

			$table->dropForeign(['seed_id']);
		});
	}

}
