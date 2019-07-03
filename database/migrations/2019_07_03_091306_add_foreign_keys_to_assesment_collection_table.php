<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAssesmentCollectionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('assesment_collection', function(Blueprint $table)
		{
			$table->foreign('assesment_id', 'fk_assesment_collection_assesment1')->references('id')->on('assesment')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('collection_id', 'fk_assesment_collection_collection1')->references('id')->on('collection')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('department_id', 'fk_assesment_collection_department1')->references('id')->on('department')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('project_id', 'fk_assesment_collection_project1')->references('id')->on('project')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('seed_id', 'fk_assesment_collection_seed1')->references('id')->on('seed')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('assesment_collection', function(Blueprint $table)
		{
			$table->dropForeign('fk_assesment_collection_assesment1');
			$table->dropForeign('fk_assesment_collection_collection1');
			$table->dropForeign('fk_assesment_collection_department1');
			$table->dropForeign('fk_assesment_collection_project1');
			$table->dropForeign('fk_assesment_collection_seed1');
		});
	}

}
