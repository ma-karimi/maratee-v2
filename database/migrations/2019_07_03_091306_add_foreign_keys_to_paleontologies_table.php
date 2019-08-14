<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPaleontologiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('paleontologies', function(Blueprint $table)
		{
			$table->foreign('geology_age_id')->references('id')->on('geology_ages')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('plant_id')->references('id')->on('plants')->onUpdate('NO ACTION')->onDelete('CASCADE');

        });
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('paleontologies', function(Blueprint $table)
		{
			$table->dropForeign(['geology_age_id']);
			$table->dropForeign(['plant_id']);
		});
	}

}
