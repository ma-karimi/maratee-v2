<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMedicinalPlantConstituentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('medicinal_plant_constituent', function(Blueprint $table)
		{
		    $table->increments('id');
			$table->unsignedInteger('medicinal_plant_id')->index('fk_medicinal_plant_has_constituent_medicinal_plant1_idx');
			$table->unsignedInteger('constituent_id')->index('fk_medicinal_plant_has_constituent_constituent1_idx');
			$table->integer('value')->nullable();
//			$table->primary(['medicinal_plant_id','constituent_id']);

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
		Schema::drop('medicinal_plant_constituent');
	}

}
