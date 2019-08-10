<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMedicinalPlantMorphologiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('medicinal_plant_morphologies', function(Blueprint $table)
		{
			$table->foreign('medicinal_plant_id')->references('id')->on('medicinal_plants')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('morphology_id')->references('id')->on('morphologies')->onUpdate('NO ACTION')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('medicinal_plant_morphologies', function(Blueprint $table)
		{
			$table->dropForeign(['medicinal_plant_id']);
			$table->dropForeign(['morphology_id']);
		});
	}

}
