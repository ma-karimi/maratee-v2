<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSeedChemicalTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('seed_chemical', function(Blueprint $table)
		{
			$table->foreign('chemical_id', 'fk_seed_chemical_chemical1')->references('id')->on('chemical')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('location_id', 'fk_seed_chemical_location1')->references('id')->on('location')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('seed_id', 'fk_seed_chemical_seed1')->references('id')->on('seed')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('seed_chemical', function(Blueprint $table)
		{
			$table->dropForeign('fk_seed_chemical_chemical1');
			$table->dropForeign('fk_seed_chemical_location1');
			$table->dropForeign('fk_seed_chemical_seed1');
		});
	}

}
