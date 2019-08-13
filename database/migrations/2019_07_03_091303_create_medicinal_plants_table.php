<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMedicinalPlantsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('medicinal_plants', function(Blueprint $table)
		{
			$table->increments('id');
			$table->unsignedInteger('plant_application_id')->nullable();
			$table->integer('code_no')->nullable();
			$table->json('treatment')->nullable();
			$table->json('cultivated_area')->nullable();
			$table->json('vast_cultivation')->nullable()->comment('options:
raw
processed
');
			$table->json('studied_sample')->nullable()->comment('options:
wild
cultivated
');
			$table->float('efficiency', 2, 0)->nullable();
			$table->json('secondary_metabolite')->nullable();
			$table->unsignedInteger('location_id');
			$table->unsignedInteger('article_id')->nullable();
			$table->json('exclusivity')->nullable();
			$table->json('life_cycle')->nullable();
			$table->json('phenology_stage')->nullable();
			$table->json('used_origin')->nullable();
			$table->json('used_type')->nullable();

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
		Schema::drop('medicinal_plants');
	}

}
