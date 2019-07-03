<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToLocationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('location', function(Blueprint $table)
		{
			$table->foreign('location_id', 'fk_location_address1')->references('id')->on('address')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('region_id', 'fk_location_region1')->references('id')->on('region')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('location', function(Blueprint $table)
		{
			$table->dropForeign('fk_location_address1');
			$table->dropForeign('fk_location_region1');

		});
	}

}
