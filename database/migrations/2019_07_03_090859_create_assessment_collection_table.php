<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAssessmentCollectionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('assessment_collections', function(Blueprint $table)
		{
			$table->unsignedInteger('collection_id');
			$table->unsignedInteger('assessment_id');
			$table->unsignedInteger('seed_id');
			$table->unsignedInteger('department_id')->nullable();
			$table->unsignedInteger('project_id')->nullable();
            $table->unsignedInteger('person_id');
			$table->unsignedInteger('creator_id');
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
		Schema::drop('assessment_collections');
	}

}
