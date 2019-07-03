<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToHerbariumGrowthTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('herbarium_growth', function(Blueprint $table)
		{
			$table->foreign('growth_id', 'fk_herbarium_has_growth_growth1')->references('id')->on('growth')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('herbarium_id', 'fk_herbarium_has_growth_herbarium1')->references('id')->on('herbarium')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('herbarium_growth', function(Blueprint $table)
		{
			$table->dropForeign('fk_herbarium_has_growth_growth1');
			$table->dropForeign('fk_herbarium_has_growth_herbarium1');
		});
	}

}
