<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToBotanicalPropagationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('botanical_propagations', function(Blueprint $table)
		{
			$table->foreign('botanical_id')->references('id')->on('botanicals')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('propagation_id')->references('id')->on('propagations')->onUpdate('NO ACTION')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('botanical_propagations', function(Blueprint $table)
		{
			$table->dropForeign(['botanical_id']);
			$table->dropForeign(['propagation_id']);
		});
	}

}
