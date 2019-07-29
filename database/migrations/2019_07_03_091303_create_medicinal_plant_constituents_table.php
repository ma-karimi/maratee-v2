<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMedicinalPlantConstituentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('medicinal_plant_constituents', function(Blueprint $table)
		{
			$table->unsignedInteger('medicinal_plant_id');
			$table->unsignedInteger('constituent_id');
			$table->integer('value');


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
		Schema::drop('medicinal_plant_constituents');
	}

}
