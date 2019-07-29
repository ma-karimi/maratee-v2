<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMedicinalPlantConstituentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('medicinal_plant_constituents', function(Blueprint $table)
		{
			$table->foreign('constituent_id')->references('id')->on('constituents')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('medicinal_plant_id')->references('id')->on('medicinal_plants')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('medicinal_plant_constituents', function(Blueprint $table)
		{
			$table->dropForeign(['constituent_id']);
			$table->dropForeign(['medicinal_plant_id']);
		});
	}

}
