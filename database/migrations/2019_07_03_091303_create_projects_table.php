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
			$table->bigIncrements('id');
			$table->json('title');
			$table->string('project_no')->nullable();
			$table->string('research_no')->nullable();
			$table->json('research_title')->nullable();
            $table->unsignedBigInteger('project_leader_id')->nullable();
            $table->unsignedBigInteger('research_leader_id')->nullable();

            $table->timeStamps();
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
