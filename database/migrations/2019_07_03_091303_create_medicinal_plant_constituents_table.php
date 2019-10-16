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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('medicinal_plant_id');
			$table->unsignedBigInteger('constituent_id');
			$table->unsignedBigInteger('constituent_type_id');
			$table->float('value', 4, 2);


            $table->timeStamps();
            $table->softDeletesTz();
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
