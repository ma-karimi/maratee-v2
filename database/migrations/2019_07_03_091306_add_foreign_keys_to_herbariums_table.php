<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToHerbariumsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('herbariums', function(Blueprint $table)
		{
			$table->foreign('location_id')->references('id')->on('locations')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('organization_id')->references('id')->on('organizations')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('phenology_id')->references('id')->on('plantologies')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('plant_group_id')->references('id')->on('plant_generals')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('plant_type_id')->references('id')->on('plantologies')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('protection_id')->references('id')->on('protections')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('herbariums', function(Blueprint $table)
		{
			$table->dropForeign(['location_id']);
			$table->dropForeign(['organization_id']);
			$table->dropForeign(['phenology_id']);
			$table->dropForeign(['plant_group_id']);
			$table->dropForeign(['plant_type_id']);
			$table->dropForeign(['protection_id']);
		});
	}

}
