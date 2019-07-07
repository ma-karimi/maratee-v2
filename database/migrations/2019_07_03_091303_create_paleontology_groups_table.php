<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaleontologyGroupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('paleontology_groups', function(Blueprint $table)
		{
			$table->unsignedInteger('plant_group_id');
			$table->unsignedInteger('plant_order_id');
			$table->unsignedInteger('paleontology_id');
			$table->unsignedInteger('plant_hub_id');
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
		Schema::drop('paleontology_groups');
	}

}
