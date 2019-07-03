<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSeedExchangeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('seed_exchange', function(Blueprint $table)
		{
			$table->foreign('collection_id', 'fk_seed_exchange_collection1')->references('id')->on('collection')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('person_id', 'fk_seed_exchange_person1')->references('id')->on('person')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('seed_id', 'fk_seed_exchange_seed1')->references('id')->on('seed')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('seed_exchange', function(Blueprint $table)
		{
			$table->dropForeign('fk_seed_exchange_collection1');
			$table->dropForeign('fk_seed_exchange_person1');
			$table->dropForeign('fk_seed_exchange_seed1');
		});
	}

}
