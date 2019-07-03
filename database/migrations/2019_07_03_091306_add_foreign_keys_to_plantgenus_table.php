<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPlantgenusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('plantgenus', function(Blueprint $table)
		{
			$table->foreign('Author_id', 'fk_plantgenus_Author1')->references('id')->on('Author')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('plantgenus', function(Blueprint $table)
		{
			$table->dropForeign('fk_plantgenus_Author1');
		});
	}

}
