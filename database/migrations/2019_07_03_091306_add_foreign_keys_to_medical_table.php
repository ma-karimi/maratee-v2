<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMedicalTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('medical', function(Blueprint $table)
		{
			$table->foreign('herbarium_id', 'fk_herbarium_has_medicine_side_effect_herbarium1')->references('id')->on('herbarium')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('medicine_side_effect_id', 'fk_herbarium_has_medicine_side_effect_medicine_side_effect1')->references('id')->on('medicine_side_effect')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('drug_id', 'fk_medical_drug1')->references('id')->on('drug')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('drug_shape_id', 'fk_medical_drug_shape1')->references('id')->on('drug_shape')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('drug_usage_id', 'fk_medical_drug_usage1')->references('id')->on('drug_usage')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('medicinal_part_id', 'fk_medical_medicinal_part1')->references('id')->on('medicinal_part')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('medicine_effect_id', 'fk_medical_medicine_effect1')->references('id')->on('medicine_effect')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('product_id', 'fk_medical_product1')->references('id')->on('product')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('therapy_id', 'fk_medical_therapy1')->references('id')->on('therapy')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('medical', function(Blueprint $table)
		{
			$table->dropForeign('fk_herbarium_has_medicine_side_effect_herbarium1');
			$table->dropForeign('fk_herbarium_has_medicine_side_effect_medicine_side_effect1');
			$table->dropForeign('fk_medical_drug1');
			$table->dropForeign('fk_medical_drug_shape1');
			$table->dropForeign('fk_medical_drug_usage1');
			$table->dropForeign('fk_medical_medicinal_part1');
			$table->dropForeign('fk_medical_medicine_effect1');
			$table->dropForeign('fk_medical_product1');
			$table->dropForeign('fk_medical_therapy1');
		});
	}

}
