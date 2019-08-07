<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSeedMolecularsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('seed_moleculars', function(Blueprint $table)
		{
			$table->foreign('location_id')->references('id')->on('locations')->onUpdate('NO ACTION')->onDelete('cascade');
			$table->foreign('molecular_id')->references('id')->on('moleculars')->onUpdate('NO ACTION')->onDelete('cascade');
			$table->foreign('seed_id')->references('id')->on('seeds')->onUpdate('NO ACTION')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('seed_moleculars', function(Blueprint $table)
		{
			$table->dropForeign(['location_id']);
			$table->dropForeign(['molecular_id']);
			$table->dropForeign(['seed_id']);
		});
	}

}
