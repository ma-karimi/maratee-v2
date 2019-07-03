<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMedicinalPlantMorphologyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('medicinal_plant_morphology', function(Blueprint $table)
		{
			$table->foreign('medicinal_plant_id', 'fk_medicinal_plant_has_morphology_medicinal_plant1')->references('id')->on('medicinal_plant')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('morphology_id', 'fk_medicinal_plant_has_morphology_morphology1')->references('id')->on('morphology')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('medicinal_plant_morphology', function(Blueprint $table)
		{
			$table->dropForeign('fk_medicinal_plant_has_morphology_medicinal_plant1');
			$table->dropForeign('fk_medicinal_plant_has_morphology_morphology1');
		});
	}

}
