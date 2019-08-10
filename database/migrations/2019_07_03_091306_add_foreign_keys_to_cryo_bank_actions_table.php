<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCryoBankActionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('cryo_bank_actions', function(Blueprint $table)
		{
			$table->foreign('action_id')->references('id')->on('actions')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('cryo_bank_id')->references('id')->on('cryo_banks')->onUpdate('NO ACTION')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('cryo_bank_actions', function(Blueprint $table)
		{
			$table->dropForeign(['action_id']);
			$table->dropForeign(['cryo_bank_id']);
		});
	}

}
