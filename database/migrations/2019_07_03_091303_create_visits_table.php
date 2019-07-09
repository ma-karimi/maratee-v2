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


            $table->dateTime('date');
			$table->json('description')->nullable();
			$table->json('purpose')->nullable();
			$table->integer('peoples')->nullable();
			$table->string('archives_types', 45)->nullable();
			$table->string('archive_no', 45)->nullable();
			$table->unsignedInteger('paleontology_id')->nullable();
			$table->unsignedInteger('media_id')->nullable();
			$table->unsignedInteger('user_id');

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
		Schema::drop('visits');
	}

}
