<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPlantclassTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('plantclass', function(Blueprint $table)
		{
			$table->foreign('Author_id', 'fk_plantclass_Author1')->references('id')->on('Author')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('plantclass', function(Blueprint $table)
		{
			$table->dropForeign('fk_plantclass_Author1');
		});
	}

}
