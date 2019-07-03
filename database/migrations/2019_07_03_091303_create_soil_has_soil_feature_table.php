<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSoilHasSoilFeatureTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('soil_has_soil_feature', function(Blueprint $table)
		{
		    $table->increments('id');
			$table->unsignedInteger('soil_id')->index('fk_soil_has_soil_feature_soil1_idx');
			$table->unsignedInteger('soil_feature_id')->index('fk_soil_has_soil_feature_soil_feature1_idx');
			$table->text('value')->nullable();
//			$table->primary(['soil_id','soil_feature_id']);
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
		Schema::drop('soil_has_soil_feature');
	}

}
