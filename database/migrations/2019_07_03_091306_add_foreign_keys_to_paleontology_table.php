<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPaleontologyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('paleontology', function(Blueprint $table)
		{
			$table->foreign('geology_age_id', 'fk_paleontology_geology_age1')->references('id')->on('geology_age')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('paleontology', function(Blueprint $table)
		{
			$table->dropForeign('fk_paleontology_geology_age1');
		});
	}

}
