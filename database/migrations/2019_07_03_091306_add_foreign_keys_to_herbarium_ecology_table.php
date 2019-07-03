<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToHerbariumEcologyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('herbarium_ecology', function(Blueprint $table)
		{
			$table->foreign('ecology_id', 'fk_herbarium_has_ecology_ecology1')->references('id')->on('ecology')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('herbarium_id', 'fk_herbarium_has_ecology_herbarium1')->references('id')->on('herbarium')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('herbarium_ecology', function(Blueprint $table)
		{
			$table->dropForeign('fk_herbarium_has_ecology_ecology1');
			$table->dropForeign('fk_herbarium_has_ecology_herbarium1');
		});
	}

}
