<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMedicinalPlantProvincesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('medicinal_plant_provinces', function(Blueprint $table)
		{
			$table->unsignedBigInteger('medicinal_plant_id');
			$table->unsignedBigInteger('province_id');
            $table->timeStamps();
            $table->softDeletesTz();
            $table->foreign('medicinal_plant_id')->references('id')->on('medicinal_plants')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('province_id')->references('id')->on('provinces')->onUpdate('NO ACTION')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('medicinal_plant_provinces');
	}

}
