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
			$table->foreign('plant_id')->references('id')->on('plants')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('seed_id')->references('id')->on('seeds')->onUpdate('NO ACTION')->onDelete('NO ACTION');
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
			$table->dropForeign(['plant_id']);
			$table->dropForeign(['seed_id']);
		});
	}

}
