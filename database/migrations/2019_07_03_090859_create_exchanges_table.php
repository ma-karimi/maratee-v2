<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExchangesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('exchanges', function(Blueprint $table)
		{
			$table->increments('id');
			$table->unsignedInteger('send_herbarium_id');
			$table->dateTime('send_date')->nullable();
			$table->dateTime('receive_date')->nullable();
			$table->json('description')->nullable();
			$table->unsignedInteger('receive_herbarium_id1')->nullable();
			$table->integer('send_sheet_no')->nullable();
			$table->integer('send_sample_no')->nullable();
			$table->integer('receive_sheet_no')->nullable();
			$table->integer('receive_sample_no')->nullable();
			$table->string('send_type', 45)->nullable();
			$table->string('receive_type', 45)->nullable();
			$table->unsignedInteger('send_paleontology_id')->nullable();
			$table->unsignedInteger('receive_paleontology_id1')->nullable();

            $table->unsignedInteger('person_id');
			$table->unsignedInteger('creator_id');
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
		Schema::drop('exchanges');
	}

}
