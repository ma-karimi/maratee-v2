<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPaleontagroupTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('paleontology_group', function(Blueprint $table)
		{
			$table->foreign('paleontology_id', 'fk_paleontology_group_paleontology1')->references('id')->on('paleontology')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('plantgroup_id', 'fk_paleontology_group_plantgroup1')->references('id')->on('plantgroup')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('planthub_id', 'fk_paleontology_group_planthub1')->references('id')->on('planthub')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('plantorder_id', 'fk_paleontology_group_plantorder1')->references('id')->on('plantorder')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('paleontology_group', function(Blueprint $table)
		{
			$table->dropForeign('fk_paleontology_group_paleontology1');
			$table->dropForeign('fk_paleontology_group_plantgroup1');
			$table->dropForeign('fk_paleontology_group_planthub1');
			$table->dropForeign('fk_paleontology_group_plantorder1');
		});
	}

}
