<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBotanicalIrrigationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('botanical_irrigation', function(Blueprint $table)
		{
		    $table->increments('id');
			$table->unsignedInteger('botanical_id')->index('fk_botanical_has_irrigation_botanical1_idx');
			$table->unsignedInteger('irrigation_id')->index('fk_botanical_has_irrigation_irrigation1_idx');
			$table->text('requirement')->nullable();
			$table->text('daytime')->nullable();
			$table->text('seasonal_feature')->nullable()->comment('features are :
value
description
per season
');
//			$table->primary(['botanical_id','irrigation_id']);


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
		Schema::drop('botanical_irrigation');
	}

}
