<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToBotanicalIrrigationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('botanical_irrigation', function(Blueprint $table)
		{
			$table->foreign('botanical_id', 'fk_botanical_has_irrigation_botanical1')->references('id')->on('botanical')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('irrigation_id', 'fk_botanical_has_irrigation_irrigation1')->references('id')->on('irrigation')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('botanical_irrigation', function(Blueprint $table)
		{
			$table->dropForeign('fk_botanical_has_irrigation_botanical1');
			$table->dropForeign('fk_botanical_has_irrigation_irrigation1');
		});
	}

}
