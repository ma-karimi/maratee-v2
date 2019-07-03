<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAssessmentCollectionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('assessment_collection', function(Blueprint $table)
		{
			$table->foreign('assessment_id', 'fk_assessment_collection_assessment1')->references('id')->on('assessment')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('collection_id', 'fk_assessment_collection_collection1')->references('id')->on('collection')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('department_id', 'fk_assessment_collection_department1')->references('id')->on('department')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('project_id', 'fk_assessment_collection_project1')->references('id')->on('project')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('seed_id', 'fk_assessment_collection_seed1')->references('id')->on('seed')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('assessment_collection', function(Blueprint $table)
		{
			$table->dropForeign('fk_assessment_collection_assessment1');
			$table->dropForeign('fk_assessment_collection_collection1');
			$table->dropForeign('fk_assessment_collection_department1');
			$table->dropForeign('fk_assessment_collection_project1');
			$table->dropForeign('fk_assessment_collection_seed1');
		});
	}

}
