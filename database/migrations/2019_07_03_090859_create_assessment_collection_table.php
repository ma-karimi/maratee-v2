<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAssessmentCollectionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('assessment_collection', function(Blueprint $table)
		{
		    $table->increments('id');
			$table->unsignedInteger('collection_id')->index('fk_assessment_collection_collection1');
			$table->unsignedInteger('assessment_id')->index('fk_assessment_collection_assessment1_idx');
			$table->unsignedInteger('seed_id')->index('fk_assessment_collection_seed1_idx');
			$table->unsignedInteger('department_id')->nullable()->index('fk_assessment_collection_department1_idx');
			$table->unsignedInteger('project_id')->nullable()->index('fk_assessment_collection_project1_idx');
//			$table->primary(['collection_id','assessment_id','seed_id']);
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
		Schema::drop('assessment_collection');
	}

}
