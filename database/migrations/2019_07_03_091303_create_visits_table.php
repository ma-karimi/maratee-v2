<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVisitsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('visits', function(Blueprint $table)
		{
			$table->increments('id');


            $table->dateTimeTz('start_time');
            $table->dateTimeTz('end_time')->nullable();
			$table->json('description')->nullable();
			$table->json('purpose')->nullable();
			$table->integer('peoples_no')->nullable();
			$table->string('person_position')->nullable();
			$table->string('archives_types')->nullable();
			$table->string('archive_no')->nullable();
			$table->morphs('visitable');
			$table->unsignedInteger('user_id');

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
		Schema::drop('visits');
	}

}
