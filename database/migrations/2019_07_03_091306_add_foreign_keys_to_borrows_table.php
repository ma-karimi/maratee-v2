<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToBorrowsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('borrows', function(Blueprint $table)
		{
			$table->foreign('send_department_id')->references('id')->on('departments')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('receive_department_id')->references('id')->on('departments')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('user_id')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('CASCADE');


		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('borrows', function(Blueprint $table)
		{
			$table->dropForeign(['send_department_id']);
			$table->dropForeign(['receive_department_id']);
			$table->dropForeign(['user_id']);

		});
	}

}
