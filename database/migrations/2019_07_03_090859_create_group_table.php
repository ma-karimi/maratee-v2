<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGroupTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('group', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('role_id')->index('fk_group_role1_idx');
			$table->date('assign')->nullable();
			$table->text('permissions')->nullable();
			$table->integer('permission_id')->index('fk_group_permission1_idx');
			$table->integer('person_id')->index('fk_group_person1_idx');
			$table->text('role')->nullable();
			$table->integer('department_id')->index('fk_group_department1_idx');
			$table->integer('organization_id')->index('fk_group_organization1_idx');

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
		Schema::drop('group');
	}

}
