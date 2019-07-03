<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePersonTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('person', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('title')->nullable();
			$table->text('education')->nullable();
			$table->text('degree')->nullable();
			$table->integer('national_id')->nullable();
			$table->date('birthday')->nullable();
			$table->text('nationality')->nullable();
			$table->string('passport_no', 45)->nullable();
			$table->text('first_name')->nullable();
			$table->text('last_name')->nullable();
			$table->text('nickname')->nullable();
			$table->text('is_author')->nullable();
			$table->integer('mobile')->nullable();
			$table->integer('phone')->nullable();
			$table->text('email')->nullable();
			$table->text('work_experience')->nullable();
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
		Schema::drop('person');
	}

}
