<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLocationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('location', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('address_id')->index('fk_location_address1_idx');
			$table->integer('region_id')->nullable()->index('fk_location_region1_idx');
			$table->integer('altitude')->nullable();
			$table->point('point')->nullable();
			$table->json('name')->nullable();
			$table->json('description')->nullable();

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
		Schema::drop('location');
	}

}
