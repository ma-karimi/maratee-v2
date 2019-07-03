<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCountryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('country', function(Blueprint $table)
		{
			$table->foreign('continent_id', 'fk_country_continent1')->references('id')->on('continent')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('country', function(Blueprint $table)
		{
			$table->dropForeign('fk_country_continent1');
		});
	}

}
