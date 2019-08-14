<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToBioMolecularsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('bio_moleculars', function(Blueprint $table)
		{
			$table->foreign('technology_id')->references('id')->on('technologies')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('block_id')->references('id')->on('blocks')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('seed_feature_id')->references('id')->on('seed_features')->onUpdate('NO ACTION')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('bio_moleculars', function(Blueprint $table)
		{
			$table->dropForeign(['chemical_id']);
			$table->dropForeign(['location_id']);
			$table->dropForeign(['seed_id']);
		});
	}

}
