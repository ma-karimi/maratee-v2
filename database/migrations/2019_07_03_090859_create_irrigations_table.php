<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIrrigationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('irrigations', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->json('type');
			$table->json('description')->nullable();


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
		Schema::drop('irrigations');
	}

}
