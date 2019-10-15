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
            $table->unsignedBigInteger('province_id');
            $table->unsignedBigInteger('city_id')->nullable();
            $table->json('region_name')->nullable();
            $table->json('address')->nullable();
            $table->unsignedBigInteger('village_id')->nullable();

            $table->integer('min_altitude')->nullable();
            $table->integer('max_altitude')->nullable();
			$table->point('point')->nullable();
			$table->json('description')->nullable();
	     	$table->boolean('gps_used')->default(0);
			$table->text('gps_datum')->nullable();


            $table->timeStamps();
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
