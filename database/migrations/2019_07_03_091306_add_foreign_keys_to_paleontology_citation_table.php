<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPaleontologyCitationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('paleontology_citation', function(Blueprint $table)
		{
			$table->foreign('article_id', 'fk_paleontology_citation_article1')->references('id')->on('article')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('paleontology_id', 'fk_paleontology_citation_paleontology1')->references('id')->on('paleontology')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('person_id', 'fk_paleontology_citation_person1')->references('id')->on('person')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('photo_id', 'fk_paleontology_citation_photo1')->references('id')->on('media')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('paleontology_citation', function(Blueprint $table)
		{
			$table->dropForeign('fk_paleontology_citation_article1');
			$table->dropForeign('fk_paleontology_citation_paleontology1');
			$table->dropForeign('fk_paleontology_citation_person1');
			$table->dropForeign('fk_paleontology_citation_photo1');
		});
	}

}
