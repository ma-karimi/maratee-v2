<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGardensTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('gardens', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->string('name');
			$table->string('region')->nullable();
			$table->string('section')->nullable();
			$table->string('number')->nullable();


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
		Schema::drop('gardens');
	}

}
