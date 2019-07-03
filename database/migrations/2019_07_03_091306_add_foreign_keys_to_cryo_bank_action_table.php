<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCryoBankActionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('cryo_bank_action', function(Blueprint $table)
		{
			$table->foreign('action_id', 'fk_cryo_bank_has_action_action1')->references('id')->on('action')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('cryo_bank_id', 'fk_cryo_bank_has_action_cryo_bank1')->references('id')->on('cryo_bank')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('cryo_bank_action', function(Blueprint $table)
		{
			$table->dropForeign('fk_cryo_bank_has_action_action1');
			$table->dropForeign('fk_cryo_bank_has_action_cryo_bank1');
		});
	}

}
