<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMedicinalPlantMethodsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('medicinal_plant_methods', function(Blueprint $table)
		{
            $table->bigIncrements('id');
            $table->unsignedBigInteger('medicinal_plant_id');
			$table->unsignedBigInteger('method_id');

            $table->timeStampsTz();
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
		Schema::drop('medicinal_plant_methods');
	}

}
