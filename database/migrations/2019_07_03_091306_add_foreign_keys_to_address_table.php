<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAddressTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('address', function(Blueprint $table)
		{
			$table->foreign('village_id', 'fk_address_village1')->references('id')->on('village')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('city_id', 'fk_location_city1')->references('id')->on('city')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('address', function(Blueprint $table)
		{
			$table->dropForeign('fk_address_village1');
			$table->dropForeign('fk_location_city1');
		});
	}

}
