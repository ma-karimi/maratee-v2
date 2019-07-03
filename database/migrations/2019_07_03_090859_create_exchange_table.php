<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExchangeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('exchange', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('send-herbarium_id')->nullable()->index('fk_exchange_herbarium1_idx');
			$table->dateTime('send_date')->nullable();
			$table->dateTime('receive_date')->nullable();
			$table->text('description')->nullable();
			$table->integer('receive-herbarium_id1')->nullable()->index('fk_exchange_herbarium2_idx');
			$table->integer('send_sheet_no')->nullable();
			$table->integer('send_sample_no')->nullable();
			$table->integer('receive_sheet_no')->nullable();
			$table->integer('receive_sample_no')->nullable();
			$table->string('send_type', 45)->nullable();
			$table->string('receive_type', 45)->nullable();
			$table->integer('send_paleontology_id')->nullable()->index('fk_exchange_paleontology1_idx');
			$table->integer('receive_paleontology_id1')->nullable()->index('fk_exchange_paleontology2_idx');

            $table->integer('person_id');
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
		Schema::drop('exchange');
	}

}
