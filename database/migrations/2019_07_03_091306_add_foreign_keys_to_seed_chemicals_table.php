<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSeedChemicalsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('seed_chemicals', function(Blueprint $table)
		{
			$table->foreign('chemical_id')->references('id')->on('chemicals')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('location_id')->references('id')->on('locations')->onUpdate('NO ACTION')->onDelete('NO ACTION');
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
		Schema::table('seed_chemicals', function(Blueprint $table)
		{
			$table->dropForeign(['chemical_id']);
			$table->dropForeign(['location_id']);
			$table->dropForeign(['seed_id']);
		});
	}

}
