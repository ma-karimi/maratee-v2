<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->json('title');
			$table->json('education')->nullable();
			$table->json('degree')->nullable();
			$table->string('national_id',255)->nullable();
			$table->date('birthday')->nullable();
			$table->json('nationality')->nullable();
			$table->string('passport_no', 45)->nullable();
			$table->json('first_name');
			$table->json('last_name');
			$table->json('nickname')->nullable();
			$table->tinyInteger('is_author')->default(0)->comment('0:disable, 1:enable');
			$table->string('mobile')->nullable();
			$table->string('phone')->nullable();
			$table->string('email');
			$table->string('password');
			$table->integer('work_experience')->nullable();
			$table->tinyInteger('status')->nullable();
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
		Schema::drop('users');
	}

}
