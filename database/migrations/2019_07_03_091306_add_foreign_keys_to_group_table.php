<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToGroupTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('group', function(Blueprint $table)
		{
			$table->foreign('department_id', 'fk_group_department1')->references('id')->on('department')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('organization_id', 'fk_group_organization1')->references('id')->on('organization')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('permission_id', 'fk_group_permission1')->references('id')->on('permission')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('person_id', 'fk_group_person1')->references('id')->on('person')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('role_id', 'fk_group_role1')->references('id')->on('role')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('group', function(Blueprint $table)
		{
			$table->dropForeign('fk_group_department1');
			$table->dropForeign('fk_group_organization1');
			$table->dropForeign('fk_group_permission1');
			$table->dropForeign('fk_group_person1');
			$table->dropForeign('fk_group_role1');
		});
	}

}
