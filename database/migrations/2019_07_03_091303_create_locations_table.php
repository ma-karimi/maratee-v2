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
            $table->unsignedBigInteger('province_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->string('region_name')->nullable();
            $table->text('address_en')->nullable();
            $table->text('address_fa')->nullable();
            $table->string('village')->nullable();

            $table->integer('min_altitude')->nullable();
            $table->integer('max_altitude')->nullable();
			$table->point('point')->nullable();
			$table->text('description')->nullable();
	     	$table->boolean('gps_used')->default(0);
			$table->string('gps_datum')->nullable();


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
