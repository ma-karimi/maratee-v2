<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCryoBanksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('cryo_banks', function(Blueprint $table)
		{
			$table->foreign('taxonomy_id')->references('id')->on('taxonomies')->onUpdate('NO ACTION')->onDelete('CASCADE');

			$table->foreign('treatment_id')->references('id')->on('treatments')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('protection_id')->references('id')->on('protections')->onUpdate('NO ACTION')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('cryo_banks', function(Blueprint $table)
		{
			$table->dropForeign(['plant_herbarium_id']);
			$table->dropForeign(['treatment']);
			$table->dropForeign(['protection_id']);
		});
	}

}
