<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAttendanceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('attendance', function(Blueprint $table)
		{
			$table->increments('id');
			$table->unsignedInteger('person_id')->index('fk_attendance_person2_idx');
			$table->dateTime('start_time')->nullable();
			$table->dateTime('end_time')->nullable();
			$table->unsignedInteger('herbarium_id')->nullable()->index('fk_attendance_herbarium1_idx');

            $table->tinyInteger('status_id')->default(0);
            $table->timeStampsTz();
            $table->dateTimeTz('deleted_at')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('attendance');
	}

}
