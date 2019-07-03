<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSoilHasSoilFeatureTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('soil_has_soil_feature', function(Blueprint $table)
		{
			$table->foreign('soil_id', 'fk_soil_has_soil_feature_soil1')->references('id')->on('soil')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('soil_feature_id', 'fk_soil_has_soil_feature_soil_feature1')->references('id')->on('soil_feature')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('soil_has_soil_feature', function(Blueprint $table)
		{
			$table->dropForeign('fk_soil_has_soil_feature_soil1');
			$table->dropForeign('fk_soil_has_soil_feature_soil_feature1');
		});
	}

}
