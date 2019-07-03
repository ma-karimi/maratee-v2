<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateActionHubTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('action_hub', function(Blueprint $table)
		{
		    $table->increments('id');
			$table->integer('person_id')->index('fk_person_has_action_person1_idx');
			$table->integer('action_id')->index('fk_person_has_action_action1_idx');
			$table->integer('location_id')->nullable()->index('fk_person_has_action_location1_idx');
			$table->integer('herbarium_id')->nullable()->index('fk_action_relations_herbarium1_idx');
			$table->date('date')->nullable();
			$table->text('description')->nullable();
			$table->integer('project_id')->nullable()->index('fk_action_hub_project1_idx');
			$table->integer('department_id')->nullable()->index('fk_action_hub_department1_idx');
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
		Schema::drop('action_hub');
	}

}
