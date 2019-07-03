<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaentologyCitationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('paentology_citation', function(Blueprint $table)
		{
		    $table->increments('id');
			$table->integer('paleontology_id')->index('fk_paentology_citation_paleontology1_idx');
			$table->integer('article_id')->index('fk_paentology_citation_article1_idx');
			$table->integer('person_id')->nullable()->index('fk_paentology_citation_person1_idx');
			$table->integer('photo_id')->nullable()->index('fk_paentology_citation_photo1_idx');
			$table->string('plates_no', 45)->nullable();
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
		Schema::drop('paentology_citation');
	}

}
