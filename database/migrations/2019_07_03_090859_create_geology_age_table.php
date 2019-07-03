<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGeologyAgeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('geology_age', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('era', 45)->nullable();
			$table->string('period', 45)->nullable();
			$table->string('epoch', 45)->nullable();
			$table->string('stage', 45)->nullable();

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
		Schema::drop('geology_age');
	}

}
