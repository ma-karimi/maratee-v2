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
			$table->unsignedInteger('plant_origin_id')->nullable();
			$table->integer('code_no')->nullable();
			$table->json('treatment')->nullable();
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
			$table->unsignedInteger('herbarium_id');
			$table->unsignedInteger('location_id');
			$table->unsignedInteger('method_id');
			$table->unsignedInteger('article_id')->nullable();
			$table->json('exclusivity')->nullable();
			$table->json('life_cycle')->nullable();
			$table->json('acidity')->nullable();
			$table->unsignedInteger('soil_id')->nullable();
			$table->unsignedInteger('media_id')->nullable();
            $table->unsignedInteger('person_id');
			$table->unsignedInteger('creator_id');
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
		Schema::drop('medicinal_plants');
	}

}
