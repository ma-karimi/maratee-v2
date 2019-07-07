<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPlantApplicationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('plant_applications', function(Blueprint $table)
		{
			$table->foreign('application_id')->references('id')->on('applications')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('herbarium_id')->references('id')->on('herbarium')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('plant_part_id')->references('id')->on('plant_part')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('industry_id')->references('id')->on('industry')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('usage_type_id')->references('id')->on('usage_type')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('plant_applications', function(Blueprint $table)
		{
			$table->dropForeign('fk_herbarium_has_plant_part_application1');
			$table->dropForeign('fk_herbarium_has_plant_part_herbarium1');
			$table->dropForeign('fk_herbarium_has_plant_part_plant_part1');
			$table->dropForeign('fk_plant_application_industry1');
			$table->dropForeign('fk_plant_application_usage_type1');
		});
	}

}
