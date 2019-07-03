<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToHerbariumHabitatTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('herbarium_habitat', function(Blueprint $table)
		{
			$table->foreign('habitat_id', 'fk_herbarium_has_habitat_habitat1')->references('id')->on('habitat')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('herbarium_id', 'fk_herbarium_has_habitat_herbarium1')->references('id')->on('herbarium')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('herbarium_habitat', function(Blueprint $table)
		{
			$table->dropForeign('fk_herbarium_has_habitat_habitat1');
			$table->dropForeign('fk_herbarium_has_habitat_herbarium1');
		});
	}

}
