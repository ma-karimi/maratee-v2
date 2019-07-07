<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGroupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('groups', function(Blueprint $table)
		{
			$table->increments('id');
			$table->unsignedInteger('role_id');
			$table->date('assign')->nullable();
			$table->json('permissions')->nullable();
			$table->unsignedInteger('permission_id');
			$table->unsignedInteger('person_id');
            $table->unsignedInteger('creator_id');

            $table->json('role')->nullable();
			$table->unsignedInteger('department_id');
			$table->unsignedInteger('organization_id');

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
		Schema::drop('groups');
	}

}
