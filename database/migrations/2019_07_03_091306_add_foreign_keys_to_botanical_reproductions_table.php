<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToBotanicalReproductionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('botanical_reproductions', function(Blueprint $table)
		{
			$table->foreign('botanical_id')->references('id')->on('botanicals')->onUpdate('NO ACTION')->onDelete('cascade');
			$table->foreign('reproduction_id')->references('id')->on('reproductions')->onUpdate('NO ACTION')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('botanical_reproductions', function(Blueprint $table)
		{
			$table->dropForeign(['botanical_id']);
			$table->dropForeign(['reproduction_id']);
		});
	}

}
