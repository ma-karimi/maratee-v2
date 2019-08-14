<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSoilHasSoilFeaturesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('soil_has_soil_features', function(Blueprint $table)
		{
		    $table->increments('id');
			$table->unsignedInteger('soil_id');
			$table->unsignedInteger('soil_feature_id');
			$table->json('value');

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
		Schema::drop('soil_has_soil_features');
	}

}
