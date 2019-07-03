<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToBotanicalTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('botanical', function(Blueprint $table)
		{
			$table->foreign('herbarium_id', 'fk_garden_herbarium1')->references('id')->on('herbarium')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('botanical', function(Blueprint $table)
		{
			$table->dropForeign('fk_garden_herbarium1');
		});
	}

}
