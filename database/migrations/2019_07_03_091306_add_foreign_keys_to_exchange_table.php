<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToExchangeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('exchange', function(Blueprint $table)
		{
			$table->foreign('send-herbarium_id', 'fk_exchange_herbarium1')->references('id')->on('herbarium')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('receive-herbarium_id1', 'fk_exchange_herbarium2')->references('id')->on('herbarium')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('send_paleontology_id', 'fk_exchange_paleontology1')->references('id')->on('paleontology')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('receive_paleontology_id1', 'fk_exchange_paleontology2')->references('id')->on('paleontology')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('exchange', function(Blueprint $table)
		{
			$table->dropForeign('fk_exchange_herbarium1');
			$table->dropForeign('fk_exchange_herbarium2');
			$table->dropForeign('fk_exchange_paleontology1');
			$table->dropForeign('fk_exchange_paleontology2');
		});
	}

}
