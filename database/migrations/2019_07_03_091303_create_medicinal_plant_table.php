<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMedicinalPlantTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('medicinal_plant', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('plant_origin_id')->nullable()->index('fk_medicinal_plant_origin1_idx');
			$table->integer('code_no')->nullable();
			$table->string('treatment', 45)->nullable();
			$table->string('vast_cultivation', 45)->nullable()->comment('options:
raw
processed
');
			$table->string('studied_sample', 45)->nullable()->comment('options:
wild
cultivated
');
			$table->float('efficiency', 10, 0)->nullable();
			$table->string('secondary_metabolite', 45)->nullable();
			$table->integer('herbarium_id')->nullable()->index('fk_medicinal_plant_herbarium1_idx');
			$table->integer('location_id')->nullable()->index('fk_medicinal_plant_location1_idx');
			$table->integer('methos_id')->nullable()->index('fk_medicinal_plant_methos1_idx');
			$table->integer('article_id')->nullable()->index('fk_medicinal_plant_article1_idx');
			$table->text('exclusivity')->nullable();
			$table->text('lifecysle')->nullable();
			$table->text('acidity')->nullable();
			$table->integer('soil_id')->nullable()->index('fk_medicinal_plant_soil1_idx');
			$table->integer('media_id')->nullable()->index('fk_medicinal_plant_media1_idx');
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
		Schema::drop('medicinal_plant');
	}

}
