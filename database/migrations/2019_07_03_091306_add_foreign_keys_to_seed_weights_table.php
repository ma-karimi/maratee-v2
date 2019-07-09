<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSeedWeightsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('seed_weights', function(Blueprint $table)
		{
			$table->foreign('seed_technology_id')->references('id')->on('seed_technologies')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('seed_weights', function(Blueprint $table)
		{
			$table->dropForeign(['seed_technology_id']);
		});
	}

}
