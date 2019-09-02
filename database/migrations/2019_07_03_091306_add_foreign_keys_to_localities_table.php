<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToLocalitiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('localities', function(Blueprint $table)
		{
			$table->foreign('location_id')->references('id')->on('locations')->onUpdate('NO ACTION')->onDelete('CASCADE');
//			$table->foreign('map_id')->references('id')->on('maps')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('paleontology_id')->references('id')->on('paleontologies')->onUpdate('NO ACTION')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('localities', function(Blueprint $table)
		{
			$table->dropForeign(['location_id']);
//			$table->dropForeign(['map_id']);
			$table->dropForeign(['paleontology_id']);
		});
	}

}
