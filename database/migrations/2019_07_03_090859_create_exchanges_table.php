<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExchangesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('exchanges', function(Blueprint $table)
		{
			$table->increments('id');
			$table->unsignedInteger('send_id');
			$table->unsignedInteger('receive_id')->nullable();
			//paleontology, herbarium
			$table->string('exchange_type');
			$table->dateTime('send_date')->nullable();
			$table->dateTime('receive_date')->nullable();
			$table->json('description')->nullable();
			$table->integer('send_sheet_no')->nullable();
			$table->integer('send_sample_no')->nullable();
			$table->integer('receive_sheet_no')->nullable();
			$table->integer('receive_sample_no')->nullable();
			$table->string('send_type')->nullable()->comment('image, physical, sample');
			$table->string('receive_type')->nullable()->comment('image, physical, sample');
			$table->unsignedInteger('send_department_id')->nullable();
			$table->unsignedInteger('receive_department_id')->nullable();


            $table->timeStampsTz();
            $table->softDeletesTz();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('exchanges');
	}

}
