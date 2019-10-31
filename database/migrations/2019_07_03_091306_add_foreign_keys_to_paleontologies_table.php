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
			$table->foreign('geology_age_era_id')->references('id')->on('geology_ages')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('geology_age_epoch_id')->references('id')->on('geology_ages')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('geology_age_stage_id')->references('id')->on('geology_ages')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('geology_age_period_id')->references('id')->on('geology_ages')->onUpdate('NO ACTION')->onDelete('CASCADE');

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
			$table->dropForeign(['geology_age_era_id']);
			$table->dropForeign(['geology_age_epoch_id']);
			$table->dropForeign(['geology_age_stage_id']);
			$table->dropForeign(['geology_age_period_id']);
		});
	}

}
