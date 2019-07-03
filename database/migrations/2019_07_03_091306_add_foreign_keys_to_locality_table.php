<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToLocalityTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('locality', function(Blueprint $table)
		{
			$table->foreign('location_id', 'fk_locality_location1')->references('id')->on('location')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('map_id', 'fk_locality_map1')->references('id')->on('map')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('paleontology_id', 'fk_locality_paleontology1')->references('id')->on('paleontology')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('locality', function(Blueprint $table)
		{
			$table->dropForeign('fk_locality_location1');
			$table->dropForeign('fk_locality_map1');
			$table->dropForeign('fk_locality_paleontology1');
		});
	}

}
