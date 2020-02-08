<?php

use App\Libraries\CustomBlueprint;
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
			$table->string('national_id')->nullable();
			$table->string('name');
			$table->string('mobile')->nullable();
			$table->string('phone')->nullable();
			$table->string('email')->unique();
			$table->string('password');
			$table->tinyInteger('status_id')->default(1);
            $table->timeStamps();
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
