<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMediasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('medias', function(Blueprint $table)
		{
			$table->foreign('botanical_id')->references('id')->on('botanicals')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('medicinal_plant_id')->references('id')->on('medicinal_plants')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('product_id')->references('id')->on('products')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('herbarium_id')->references('id')->on('herbariums')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('location_id')->references('id')->on('locations')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('paleontology_id')->references('id')->on('paleontologies')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('user_id')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('seed_id')->references('id')->on('seeds')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('medias', function(Blueprint $table)
		{
			$table->dropForeign(['botanical_id']);
			$table->dropForeign(['medicinal_plant_id']);
			$table->dropForeign(['product_id']);
			$table->dropForeign(['herbarium_id']);
			$table->dropForeign(['location_id']);
			$table->dropForeign(['paleontology_id']);
			$table->dropForeign(['user_id']);
			$table->dropForeign(['seed_id']);
		});
	}

}
