<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBotanicalIrrigationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('botanical_irrigations', function(Blueprint $table)
		{
			$table->unsignedBigInteger('botanical_id');
			$table->unsignedBigInteger('irrigation_id');
			$table->json('requirement')->nullable();
			$table->json('irrigation_time');
			$table->json('seasonal_feature')->nullable()->comment('features are :
value
description
per season
');



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
		Schema::drop('botanical_irrigations');
	}

}
