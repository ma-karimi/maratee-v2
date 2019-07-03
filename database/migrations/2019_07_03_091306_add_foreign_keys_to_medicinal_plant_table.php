<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMedicinalPlantTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('medicinal_plant', function(Blueprint $table)
		{
			$table->foreign('article_id', 'fk_medicinal_plant_article1')->references('id')->on('article')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('herbarium_id', 'fk_medicinal_plant_herbarium1')->references('id')->on('herbarium')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('location_id', 'fk_medicinal_plant_location1')->references('id')->on('location')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('media_id', 'fk_medicinal_plant_media1')->references('id')->on('media')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('methos_id', 'fk_medicinal_plant_methos1')->references('id')->on('methos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('plant_origin_id', 'fk_medicinal_plant_origin1')->references('id')->on('plant_origin')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('soil_id', 'fk_medicinal_plant_soil1')->references('id')->on('soil')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('medicinal_plant', function(Blueprint $table)
		{
			$table->dropForeign('fk_medicinal_plant_article1');
			$table->dropForeign('fk_medicinal_plant_herbarium1');
			$table->dropForeign('fk_medicinal_plant_location1');
			$table->dropForeign('fk_medicinal_plant_media1');
			$table->dropForeign('fk_medicinal_plant_methos1');
			$table->dropForeign('fk_medicinal_plant_origin1');
			$table->dropForeign('fk_medicinal_plant_soil1');
		});
	}

}
