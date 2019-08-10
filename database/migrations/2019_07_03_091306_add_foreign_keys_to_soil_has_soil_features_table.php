<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSoilHasSoilFeaturesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('soil_has_soil_features', function(Blueprint $table)
		{
			$table->foreign('soil_id')->references('id')->on('soils')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('soil_feature_id')->references('id')->on('soil_features')->onUpdate('NO ACTION')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('soil_has_soil_features', function(Blueprint $table)
		{
			$table->dropForeign(['soil_id']);
			$table->dropForeign(['soil_feature_id']);
		});
	}

}
