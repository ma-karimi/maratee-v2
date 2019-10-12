<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBiochemicalEvaluationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('biochemical_evaluations', function(Blueprint $table)
		{
			$table->bigIncrements('id');
            $table->unsignedBigInteger('organization_id');
            $table->unsignedBigInteger('department_id')->nullable();
            $table->unsignedBigInteger('project_id')->nullable();
            $table->string('co_researcher_name')->nullable();
            $table->unsignedBigInteger('specimen_type_coll_id')->nullable();
            $table->string('accession_code')->nullable();
            $table->string('regeneration_and_evaluation_code')->nullable();
            $table->text('treat')->nullable();
            $table->text('repeat')->nullable();
            $table->timeStampsTz();
            $table->softDeletesTz();
            $table->foreign('specimen_type_coll_id')->references('id')->on('seed_generals')->onUpdate('NO ACTION')->onDelete('CASCADE');

        });
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('biochemical_evaluations');
	}

}
