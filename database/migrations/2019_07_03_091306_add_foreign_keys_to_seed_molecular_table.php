<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSeedMolecularTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('seed_molecular', function(Blueprint $table)
		{
			$table->foreign('location_id', 'fk_seed_molecular_location1')->references('id')->on('location')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('molecular_id', 'fk_seed_molecular_molecular1')->references('id')->on('molecular')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('seed_id', 'fk_seed_molecular_seed1')->references('id')->on('seed')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('seed_molecular', function(Blueprint $table)
		{
			$table->dropForeign('fk_seed_molecular_location1');
			$table->dropForeign('fk_seed_molecular_molecular1');
			$table->dropForeign('fk_seed_molecular_seed1');
		});
	}

}
