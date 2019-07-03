<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTreatmentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('treatment', function(Blueprint $table)
		{
			$table->foreign('paleontology_id', 'fk_treatment_paleontology1')->references('id')->on('paleontology')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('treatment', function(Blueprint $table)
		{
			$table->dropForeign('fk_treatment_paleontology1');
		});
	}

}
