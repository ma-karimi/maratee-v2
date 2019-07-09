<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAssessmentCollectionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('assessment_collections', function(Blueprint $table)
		{
			$table->foreign('assessment_id')->references('id')->on('assessments')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('collection_id')->references('id')->on('collections')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('department_id')->references('id')->on('departments')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('project_id')->references('id')->on('projects')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('seed_id')->references('id')->on('seeds')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('assessment_collections', function(Blueprint $table)
		{
            $table->dropForeign(['assessment_id']);
            $table->dropForeign(['collection_id']);
            $table->dropForeign(['department_id']);
            $table->dropForeign(['project_id']);
            $table->dropForeign(['seed_id']);
		});
	}

}
