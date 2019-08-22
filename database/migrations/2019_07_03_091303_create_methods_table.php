<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMethodsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('methods', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->json('name');
			$table->json('description')->nullable();
			$table->integer('parent_id')->nullable();

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
		Schema::drop('methods');
	}

}
