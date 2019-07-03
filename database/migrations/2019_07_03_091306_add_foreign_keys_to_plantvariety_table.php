<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPlantvarietyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('plantvariety', function(Blueprint $table)
		{
			$table->foreign('author_id', 'fk_plantvariety_author1')->references('id')->on('author')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('plantvariety', function(Blueprint $table)
		{
			$table->dropForeign('fk_plantvariety_author1');
		});
	}

}
