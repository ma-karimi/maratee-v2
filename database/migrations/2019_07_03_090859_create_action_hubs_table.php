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
		    $table->bigIncrements('id');

			$table->unsignedBigInteger('user_id');
			$table->integer('actlaraion_id')->default(1)->comment('1: detect, 2:collect, 3:research');
            //plant_herbarium, cryo_bank, paleontology
            $table->morphs('actionable');

            $table->date('date')->nullable();
			$table->json('description')->nullable();
			$table->unsignedBigInteger('project_id')->nullable();
			$table->unsignedBigInteger('department_id')->nullable();

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
		Schema::drop('action_hubs');
	}

}
