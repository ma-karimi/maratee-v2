<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCryoBankTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('cryo_bank', function(Blueprint $table)
		{
			$table->foreign('herbarium_id', 'fk_cryo_bank_herbarium1')->references('id')->on('herbarium')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('protection_id', 'fk_cryo_bank_protection1')->references('id')->on('protection')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('cryo_bank', function(Blueprint $table)
		{
			$table->dropForeign('fk_cryo_bank_herbarium1');
			$table->dropForeign('fk_cryo_bank_protection1');
		});
	}

}
