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
			$table->bigIncrements('id');
			$table->unsignedBigInteger('plant_application_id')->nullable();
			$table->integer('code_no')->nullable();
			$table->json('cultivated_area')->nullable();
			$table->json('vast_cultivation')->nullable()->comment('options:
raw
processed
');
			$table->json('studied_sample')->nullable()->comment('options:
wild
cultivated
');
			$table->float('efficiency', 4, 2)->nullable();
			$table->json('secondary_metabolite')->nullable();

			$table->json('exclusivity')->nullable();
			$table->json('life_cycle')->nullable();
			$table->json('phenology_stage')->nullable();
			$table->json('used_origin')->nullable();
			$table->json('used_type')->nullable();
			$table->string('store_type')->nullable();
            $table->unsignedBigInteger('aerial_part_id')->nullable();
            $table->unsignedBigInteger('ground_part_id')->nullable();
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
		Schema::drop('medicinal_plants');
	}

}
