<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSeedPlantTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('seed_plant', function(Blueprint $table)
		{
			$table->foreign('plant_id', 'fk_seed_plant_plant1')->references('id')->on('plant')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('seed_id', 'fk_seed_plant_seed1')->references('id')->on('seed')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('seed_plant', function(Blueprint $table)
		{
			$table->dropForeign('fk_seed_plant_plant1');
			$table->dropForeign('fk_seed_plant_seed1');
		});
	}

}
