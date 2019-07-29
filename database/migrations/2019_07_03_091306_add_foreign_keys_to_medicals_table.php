<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMedicalsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('medicals', function(Blueprint $table)
		{
			$table->foreign('herbarium_id')->references('id')->on('herbariums')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('medicine_side_effect_id')->references('id')->on('medicines')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('medicine_drug_id')->references('id')->on('medicines')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('medicine_drug_shape_id')->references('id')->on('medicines')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('medicine_drug_usage_id')->references('id')->on('medicines')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('medicine_medicinal_part_id')->references('id')->on('medicines')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('medicine_effect_id')->references('id')->on('medicines')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('product_id')->references('id')->on('products')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('medicine_therapy_id')->references('id')->on('medicines')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('medicals', function(Blueprint $table)
		{
			$table->dropForeign(['herbarium_id']);
			$table->dropForeign(['medicine_side_effect_id']);
			$table->dropForeign(['medicine_drug_id']);
			$table->dropForeign(['medicine_drug_shape_id']);
			$table->dropForeign(['medicine_drug_usage_id']);
			$table->dropForeign(['medicine_medicinal_part_id']);
			$table->dropForeign(['medicine_effect_id']);
			$table->dropForeign(['product_id']);
			$table->dropForeign(['medicine_therapy_id']);
		});
	}

}
