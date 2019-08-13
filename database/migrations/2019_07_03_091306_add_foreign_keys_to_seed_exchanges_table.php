<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSeedExchangesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('seed_exchanges', function(Blueprint $table)
		{
			$table->foreign('collection_id')->references('id')->on('collections')->onUpdate('NO ACTION')->onDelete('cascade');
			$table->foreign('seed_id')->references('id')->on('seeds')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->unsignedInteger('department_id');
            $table->unsignedInteger('project_id');
            $table->foreign('department_id')->references('id')->on('departments')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('project_id')->references('id')->on('projects')->onUpdate('NO ACTION')->onDelete('cascade');

        });
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('seed_exchanges', function(Blueprint $table)
		{
		    $table->dropColumn('department_id','project_id');
			$table->dropForeign(['collection_id']);
			$table->dropForeign(['seed_id']);
			$table->dropForeign(['department_id']);
			$table->dropForeign(['project_id']);
		});
	}

}
