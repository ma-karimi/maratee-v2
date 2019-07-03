<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToVisitTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('visit', function(Blueprint $table)
		{
			$table->foreign('media_id', 'fk_visit_media1')->references('id')->on('media')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('paleontology_id', 'fk_visit_paleontology1')->references('id')->on('paleontology')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('person_id', 'fk_visit_person1')->references('id')->on('person')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('visit', function(Blueprint $table)
		{
			$table->dropForeign('fk_visit_media1');
			$table->dropForeign('fk_visit_paleontology1');
			$table->dropForeign('fk_visit_person1');
		});
	}

}
