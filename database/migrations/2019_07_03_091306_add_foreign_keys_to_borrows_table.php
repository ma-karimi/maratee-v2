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
			$table->foreign('herbarium_id')->references('id')->on('herbariums')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('user_id')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('media_id')->references('id')->on('medias')->onUpdate('NO ACTION')->onDelete('NO ACTION');

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
			$table->dropForeign(['herbarium_id']);
			$table->dropForeign(['media_id']);
			$table->dropForeign(['user_id']);

		});
	}

}
