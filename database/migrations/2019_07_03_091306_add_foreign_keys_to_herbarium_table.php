<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToHerbariumTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('herbarium', function(Blueprint $table)
		{
			$table->foreign('location_id', 'fk_herbarium_location1')->references('id')->on('location')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('organization_id', 'fk_herbarium_organization1')->references('id')->on('organization')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('phenology_state_id', 'fk_herbarium_phenology_state1')->references('id')->on('phenology_state')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('phytogeography_id', 'fk_herbarium_phytogeography1')->references('id')->on('phytogeography')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('plantgroup_id', 'fk_herbarium_plantgroup1')->references('id')->on('planthub')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('plant_type_id', 'fk_herbarium_plant_type1')->references('id')->on('plant_type')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('protection_id', 'fk_herbarium_protection1')->references('id')->on('protection')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('herbarium', function(Blueprint $table)
		{
			$table->dropForeign('fk_herbarium_location1');
			$table->dropForeign('fk_herbarium_organization1');
			$table->dropForeign('fk_herbarium_phenology_state1');
			$table->dropForeign('fk_herbarium_phytogeography1');
			$table->dropForeign('fk_herbarium_plantgroup1');
			$table->dropForeign('fk_herbarium_plant_type1');
			$table->dropForeign('fk_herbarium_protection1');
		});
	}

}
