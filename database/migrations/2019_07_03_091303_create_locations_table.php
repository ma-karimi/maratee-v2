<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLocationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('locations', function(Blueprint $table)
		{
			$table->bigIncrements('id');
            $table->unsignedBigInteger('city_id');
            $table->json('region_name')->nullable();
            $table->json('address')->nullable();
            $table->unsignedBigInteger('village_id')->nullable();

            $table->string('altitude')->nullable();
			$table->point('point')->nullable();
			$table->json('description')->nullable();
			$table->string('gps_used')->nullable();
			$table->string('gps_datum')->nullable();


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
		Schema::drop('locations');
	}

}
