<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMedicinalPlantMorphologyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('medicinal_plant_morphology', function(Blueprint $table)
		{
            $table->increments('id');

            $table->integer('medicinal_plant_id')->index('fk_medicinal_plant_has_morphology_medicinal_plant1_idx');
			$table->integer('morphology_id')->index('fk_medicinal_plant_has_morphology_morphology1_idx');
			$table->string('value', 45)->nullable();
			$table->primary(['medicinal_plant_id','morphology_id']);
            $table->integer('person_id');
            $table->tinyInteger('status_id')->default(0);
            $table->timeStampsTz();
            $table->dateTimeTz('deleted_at')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('medicinal_plant_morphology');
	}

}
