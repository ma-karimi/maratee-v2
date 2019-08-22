<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlantApplicationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('plant_applications', function(Blueprint $table)
		{
		    $table->bigIncrements('id');
			$table->unsignedBigInteger('herbarium_id');
			$table->unsignedBigInteger('general_part_id')->nullable();
			$table->unsignedBigInteger('general_application_id')->nullable();
			$table->unsignedBigInteger('general_growth_id')->nullable();
			$table->unsignedBigInteger('general_usage_type_id')->nullable();
			$table->unsignedBigInteger('general_industry_id')->nullable();
			$table->json('presence')->nullable()->comment('options: 
now
future
to descirbe if that plant is used or could be used in the specific industry now or in future.');

			$table->string('trade_type')->nullable();
			$table->string('trade_process')->nullable();
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
		Schema::drop('plant_applications');
	}

}
