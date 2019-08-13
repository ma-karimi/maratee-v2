<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToExchangesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('exchanges', function(Blueprint $table)
		{
			$table->foreign('send_department_id')->references('id')->on('departments')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('receive_department_id')->references('id')->on('departments')->onUpdate('NO ACTION')->onDelete('CASCADE');


		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('exchanges', function(Blueprint $table)
		{
			$table->dropForeign(['send_department_id']);
			$table->dropForeign(['receive_department_id']);

		});
	}

}
