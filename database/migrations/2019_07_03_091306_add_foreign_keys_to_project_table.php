<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToProjectTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('project', function(Blueprint $table)
		{
			$table->foreign('plan_id', 'fk_project_plan1')->references('id')->on('plan')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('project', function(Blueprint $table)
		{
			$table->dropForeign('fk_project_plan1');
		});
	}

}
