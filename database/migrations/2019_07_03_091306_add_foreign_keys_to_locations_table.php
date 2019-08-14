<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToLocationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('locations', function(Blueprint $table)
		{
            $table->foreign('city_id')->references('id')->on('cities')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('village_id')->references('id')->on('villages')->onUpdate('NO ACTION')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('locations', function(Blueprint $table)
		{
			$table->dropForeign(['city_id']);
			$table->dropForeign(['village_id']);

		});
	}

}
