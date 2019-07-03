<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAssesmentCollectionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('assesment_collection', function(Blueprint $table)
		{
		    $table->increments('id');
			$table->integer('collection_id');
			$table->integer('assesment_id')->index('fk_assesment_collection_assesment1_idx');
			$table->integer('seed_id')->index('fk_assesment_collection_seed1_idx');
			$table->integer('department_id')->nullable()->index('fk_assesment_collection_department1_idx');
			$table->integer('project_id')->nullable()->index('fk_assesment_collection_project1_idx');
			$table->primary(['collection_id','assesment_id','seed_id']);
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
		Schema::drop('assesment_collection');
	}

}
