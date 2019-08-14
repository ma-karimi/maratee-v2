<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('projects', function(Blueprint $table)
		{
			$table->increments('id');
			$table->json('title');
			$table->string('project_no')->nullable();
			$table->string('research_no')->nullable();
			$table->json('research_title')->nullable();
            $table->unsignedInteger('project_leader_id')->nullable();
            $table->unsignedInteger('research_leader_id')->nullable();

            $table->timeStampsTz();
            $table->softDeletesTz();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{

		Schema::drop('projects');
	}

}
