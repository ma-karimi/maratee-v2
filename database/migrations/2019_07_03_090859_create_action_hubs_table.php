<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateActionHubsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('action_hubs', function(Blueprint $table)
		{
		    $table->increments('id');

			$table->unsignedInteger('action_id');
			$table->unsignedInteger('user_id');
			$table->unsignedInteger('location_id')->nullable();
			$table->unsignedInteger('herbarium_id')->nullable();
			$table->date('date')->nullable();
			$table->json('description')->nullable();
			$table->unsignedInteger('project_id')->nullable();
			$table->unsignedInteger('department_id')->nullable();

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
		Schema::drop('action_hubs');
	}

}
