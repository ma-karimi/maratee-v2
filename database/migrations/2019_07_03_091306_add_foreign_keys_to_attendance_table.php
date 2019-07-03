<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAttendanceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('attendance', function(Blueprint $table)
		{
			$table->foreign('herbarium_id', 'fk_attendance_herbarium1')->references('id')->on('herbarium')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('person_id', 'fk_attendance_person2')->references('id')->on('person')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('attendance', function(Blueprint $table)
		{
			$table->dropForeign('fk_attendance_herbarium1');
			$table->dropForeign('fk_attendance_person2');
		});
	}

}
