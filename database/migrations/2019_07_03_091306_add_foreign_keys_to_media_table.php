<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMediaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('media', function(Blueprint $table)
		{
			$table->foreign('botanical_id', 'fk_media_botanical1')->references('id')->on('botanical')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('medicinal_plant_id', 'fk_media_medicinal_plant1')->references('id')->on('medicinal_plant')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('product_id', 'fk_media_product1')->references('id')->on('product')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('herbarium_id', 'fk_photo_herbarium1')->references('id')->on('herbarium')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('location_id', 'fk_photo_location1')->references('id')->on('location')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('paleontology_id', 'fk_photo_paleontology1')->references('id')->on('paleontology')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('person_id', 'fk_photo_person1')->references('id')->on('person')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('seed_id', 'fk_photo_seed1')->references('id')->on('seed')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('media', function(Blueprint $table)
		{
			$table->dropForeign('fk_media_botanical1');
			$table->dropForeign('fk_media_medicinal_plant1');
			$table->dropForeign('fk_media_product1');
			$table->dropForeign('fk_photo_herbarium1');
			$table->dropForeign('fk_photo_location1');
			$table->dropForeign('fk_photo_paleontology1');
			$table->dropForeign('fk_photo_person1');
			$table->dropForeign('fk_photo_seed1');
		});
	}

}
