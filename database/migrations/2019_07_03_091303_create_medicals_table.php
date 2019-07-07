<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMedicalsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('medicals', function(Blueprint $table)
		{
			$table->unsignedInteger('herbarium_id');
			$table->unsignedInteger('medicine_side_effect_id')->nullable();
			$table->json('side_effect_description')->nullable();
			$table->unsignedInteger('medicine_effect_id');
			$table->string('medicine_effect_description', 45)->nullable();
			$table->unsignedInteger('therapy_id')->nullable();
			$table->string('therapy_description', 45)->nullable();
			$table->unsignedInteger('drug_id')->nullable();
			$table->json('drug_description')->nullable();
			$table->unsignedInteger('product_id')->nullable();
			$table->unsignedInteger('drug_shape_id')->nullable();
			$table->unsignedInteger('medicinal_part_id');
			$table->unsignedInteger('drug_usage_id')->nullable();

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
		Schema::drop('medicals');
	}

}
