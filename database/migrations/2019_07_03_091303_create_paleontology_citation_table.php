<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaleontologyCitationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('paleontology_citation', function(Blueprint $table)
		{
		    $table->increments('id');
			$table->unsignedInteger('paleontology_id')->index('fk_paleontology_citation_paleontology1_idx');
			$table->unsignedInteger('article_id')->index('fk_paleontology_citation_article1_idx');
			$table->unsignedInteger('person_id')->nullable()->index('fk_paleontology_citation_person1_idx');
			$table->unsignedInteger('photo_id')->nullable()->index('fk_paleontology_citation_photo1_idx');
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
		Schema::drop('paleontology_citation');
	}

}
