<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPaleontologyActionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('paleontology_action', function(Blueprint $table)
		{
			$table->foreign('action_id', 'fk_paleontology_action_action1')->references('id')->on('action')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('paleontology_id', 'fk_paleontology_action_paleontology1')->references('id')->on('paleontology')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('person_id', 'fk_paleontology_action_person1')->references('id')->on('person')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('paleontology_action', function(Blueprint $table)
		{
			$table->dropForeign('fk_paleontology_action_action1');
			$table->dropForeign('fk_paleontology_action_paleontology1');
			$table->dropForeign('fk_paleontology_action_person1');
		});
	}

}
