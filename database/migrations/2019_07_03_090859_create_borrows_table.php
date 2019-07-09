<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBorrowsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('borrows', function(Blueprint $table)
		{
			$table->increments('id');
			$table->unsignedInteger('herbarium_id');
			$table->unsignedInteger('user_id');

			$table->dateTime('borrows_date');
			$table->integer('sheets_no')->nullable()->comment('total number of sheets ');
			$table->date('deadline');
			$table->date('return')->nullable();
			$table->unsignedInteger('media_id')->nullable();


            $table->timeStampsTz();
            $table->dateTimeTz('deleted_at')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('borrows');
	}

}
