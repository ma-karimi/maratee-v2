<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMedicinalPlantsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('medicinal_plants', function(Blueprint $table)
		{
			$table->foreign('plant_application_id')->references('id')->on('plant_applications')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('aerial_part_id')->references('id')->on('medicinal_parts')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('ground_part_id')->references('id')->on('medicinal_parts')->onUpdate('NO ACTION')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('medicinal_plants', function(Blueprint $table)
		{
			$table->dropForeign(['plant_application_id','aerial_part_id','ground_part_id']);
		});
	}

}
