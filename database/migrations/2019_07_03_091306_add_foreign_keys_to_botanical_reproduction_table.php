<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToBotanicalReproductionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('botanical_reproduction', function(Blueprint $table)
		{
			$table->foreign('botanical_id', 'fk_botanical_has_reproduction_botanical1')->references('id')->on('botanical')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('reproduction_id', 'fk_botanical_has_reproduction_reproduction1')->references('id')->on('reproduction')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('botanical_reproduction', function(Blueprint $table)
		{
			$table->dropForeign('fk_botanical_has_reproduction_botanical1');
			$table->dropForeign('fk_botanical_has_reproduction_reproduction1');
		});
	}

}
