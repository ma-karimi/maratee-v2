<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTechnologyCollectionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('technology_collection', function(Blueprint $table)
		{
			$table->foreign('collection_id', 'fk_seed_technology_has_collection_collection1')->references('id')->on('collection')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('seed_technology_id', 'fk_seed_technology_has_collection_seed_technology1')->references('id')->on('seed_technology')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('technology_collection', function(Blueprint $table)
		{
			$table->dropForeign('fk_seed_technology_has_collection_collection1');
			$table->dropForeign('fk_seed_technology_has_collection_seed_technology1');
		});
	}

}
