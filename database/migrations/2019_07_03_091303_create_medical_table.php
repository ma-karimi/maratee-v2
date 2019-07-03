<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMedicalTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('medical', function(Blueprint $table)
		{
		    $table->increments('id');
			$table->unsignedInteger('herbarium_id')->index('fk_herbarium_has_medicine_side_effect_herbarium1_idx');
			$table->unsignedInteger('medicine_side_effect_id')->nullable()->index('fk_herbarium_has_medicine_side_effect_medicine_side_effect1_idx');
			$table->text('side_effect_description')->nullable();
			$table->unsignedInteger('medicine_effect_id')->nullable()->index('fk_medical_medicine_effect1_idx');
			$table->string('medicine_effect_descrition', 45)->nullable();
			$table->unsignedInteger('therapy_id')->nullable()->index('fk_medical_therapy1_idx');
			$table->string('therapy_description', 45)->nullable();
			$table->unsignedInteger('drug_id')->nullable()->index('fk_medical_drug1_idx');
			$table->text('drug_description')->nullable();
			$table->unsignedInteger('product_id')->nullable()->index('fk_medical_product1_idx');
			$table->unsignedInteger('drug_shape_id')->nullable()->index('fk_medical_drug_shape1_idx');
			$table->unsignedInteger('medicinal_part_id')->nullable()->index('fk_medical_medicinal_part1_idx');
			$table->unsignedInteger('drug_usage_id')->nullable()->index('fk_medical_drug_usage1_idx');

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
		Schema::drop('medical');
	}

}
