<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMedicinalPlantsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('medicinal_plants', function(Blueprint $table)
		{
			$table->foreign('article_id')->references('id')->on('articles')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('herbarium_id')->references('id')->on('herbariums')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('location_id')->references('id')->on('locations')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('media_id')->references('id')->on('medias')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('method_id')->references('id')->on('methods')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('plant_origin_id')->references('id')->on('plant_factors')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('soil_id')->references('id')->on('soils')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('medicinal_plants', function(Blueprint $table)
		{
			$table->dropForeign(['article_id']);
			$table->dropForeign(['herbarium_id']);
			$table->dropForeign(['location_id']);
			$table->dropForeign(['media_id']);
			$table->dropForeign(['method_id']);
			$table->dropForeign(['plant_origin_id']);
			$table->dropForeign(['soil_id']);
		});
	}

}
