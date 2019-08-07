<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTreatmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('treatments', function(Blueprint $table)
		{
			$table->foreign('paleontology_id')->references('id')->on('paleontologies')->onUpdate('NO ACTION')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('treatments', function(Blueprint $table)
		{
			$table->dropForeign(['paleontology_id']);
		});
	}

}
