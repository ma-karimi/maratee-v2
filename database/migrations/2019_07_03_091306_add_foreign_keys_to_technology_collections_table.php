<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTechnologyCollectionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('technology_collections', function(Blueprint $table)
		{
			$table->foreign('collection_id')->references('id')->on('collections')->onUpdate('NO ACTION')->onDelete('cascade');
			$table->foreign('seed_technology_id')->references('id')->on('seed_technologies')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->unsignedInteger('germination_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('project_id');
            $table->unsignedInteger('department_id');
            $table->foreign('germination_id')->references('id')->on('germinations')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('project_id')->references('id')->on('projects')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onUpdate('NO ACTION')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('technology_collections', function(Blueprint $table)
		{
			$table->dropForeign(['collection_id']);
			$table->dropForeign(['seed_technology_id']);
            $table->dropForeign('department_id');
            $table->dropForeign('project_id');
            $table->dropForeign('user_id');
            $table->dropForeign('germination_id');
            $table->dropColumn('department_id','project_id','user_id','germination_id');
		});
	}

}
