<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBorrowTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('borrow', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('herbarium_id')->index('fk_borrow_herbarium1_idx');
			$table->integer('person_id')->index('fk_borrow_person1_idx');
			$table->dateTime('borrow_date');
			$table->integer('sheets_no')->nullable()->comment('total number of sheets ');
			$table->date('deadline')->nullable();
			$table->date('return')->nullable();
			$table->integer('media_id')->nullable()->index('fk_borrow_media1_idx');

            $table->integer('person_id');
            $table->tinyInteger('status_id')->default(0);
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
		Schema::drop('borrow');
	}

}
