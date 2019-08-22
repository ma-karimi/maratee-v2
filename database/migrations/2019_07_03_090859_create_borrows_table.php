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
			$table->bigIncrements('id');

            $table->morphs('borrowable');
            //comment('herbarium, paleontology')
            $table->unsignedBigInteger('send_department_id');
            $table->unsignedBigInteger('receive_department_id');
            $table->unsignedBigInteger('user_id')->nullable();

			$table->dateTime('borrows_date');
			$table->integer('sheets_no')->nullable()->comment('total number of sheets ');
			$table->date('deadline');
			$table->date('return')->nullable();

            $table->timeStampsTz();
            $table->softDeletesTz();
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
