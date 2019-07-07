<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaleontologyCitationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('paleontology_citations', function(Blueprint $table)
		{
		    $table->increments('id');
			$table->unsignedInteger('paleontology_id');
			$table->unsignedInteger('article_id');
			$table->unsignedInteger('person_id');
            $table->unsignedInteger('creator_id');

            $table->unsignedInteger('media_id')->nullable();
			$table->string('plates_no', 45)->nullable();
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
		Schema::drop('paleontology_citations');
	}

}
