<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCryoBanksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('cryo_banks', function(Blueprint $table)
		{
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
		Schema::table('cryo_banks', function(Blueprint $table)
		{
			$table->dropForeign(['herbarium_id']);
			$table->dropForeign(['protection_id']);
		});
	}

}
