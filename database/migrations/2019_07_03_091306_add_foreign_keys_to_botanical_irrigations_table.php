<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToBotanicalIrrigationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('botanical_irrigations', function(Blueprint $table)
		{
			$table->foreign('botanical_id')->references('id')->on('botanicals')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('irrigation_id')->references('id')->on('irrigations')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('botanical_irrigations', function(Blueprint $table)
		{
			$table->dropForeign(['botanical_id']);
			$table->dropForeign(['irrigation_id']);
		});
	}

}
