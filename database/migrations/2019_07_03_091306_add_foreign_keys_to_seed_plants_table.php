<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSeedPlantsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('seed_plants', function(Blueprint $table)
		{
			$table->foreign('plant_herbarium_id')->references('id')->on('plant_herbariums')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('seed_id')->references('id')->on('seeds')->onUpdate('NO ACTION')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('seed_plants', function(Blueprint $table)
		{
			$table->dropForeign(['plant_herbarium_id']);
			$table->dropForeign(['seed_id']);
		});
	}

}
