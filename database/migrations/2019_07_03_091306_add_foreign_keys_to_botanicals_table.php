<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToBotanicalsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('botanicals', function(Blueprint $table)
		{
			$table->foreign('plant_herbarium_id')->references('id')->on('plant_herbariums')->onUpdate('NO ACTION')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('botanicals', function(Blueprint $table)
		{
			$table->dropForeign(['plant_herbarium_id']);
		});
	}

}
