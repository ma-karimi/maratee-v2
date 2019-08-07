<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToVisitsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('visits', function(Blueprint $table)
		{
			$table->foreign('media_id')->references('id')->on('medias')->onUpdate('NO ACTION')->onDelete('cascade');
			$table->foreign('paleontology_id')->references('id')->on('paleontologies')->onUpdate('NO ACTION')->onDelete('cascade');
			$table->foreign('user_id')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('cascade');

		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('visits', function(Blueprint $table)
		{
			$table->dropForeign(['media_id']);
			$table->dropForeign(['user_id']);
			$table->dropForeign(['paleontology_id']);

		});
	}

}
