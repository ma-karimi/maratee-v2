<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlantApplicationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('plant_application', function(Blueprint $table)
		{
		    $table->increments('id');
			$table->unsignedInteger('herbarium_id')->index('fk_herbarium_has_pla
nt_part_herbarium1');
			$table->unsignedInteger('plant_part_id')->nullable()->index('fk_herbarium_has_plant_part_plant_part1_idx');
			$table->unsignedInteger('application_id')->nullable()->index('fk_herbarium_has_plant_part_application1_idx');
			$table->unsignedInteger('usage_type_id')->nullable()->index('fk_plant_application_usage_type1_idx');
			$table->unsignedInteger('industry_id')->nullable()->index('fk_plant_application_industry1_idx');
			$table->text('presence')->nullable()->comment('options: 
now
future
to descirbe if that plant is used or could be used in the specific industry now or in future.');
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
		Schema::drop('plant_application');
	}

}
