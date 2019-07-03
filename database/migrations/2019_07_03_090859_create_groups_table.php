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
			$table->unsignedInteger('role_id')->index('fk_groups_role1_idx');
			$table->date('assign')->nullable();
			$table->text('permissions')->nullable();
			$table->unsignedInteger('permission_id')->index('fk_groups_permission1_idx');
			$table->unsignedInteger('person_id')->index('fk_groups_person1_idx');
			$table->text('role')->nullable();
			$table->unsignedInteger('department_id')->index('fk_groups_department1_idx');
			$table->unsignedInteger('organization_id')->index('fk_groups_organization1_idx');

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
