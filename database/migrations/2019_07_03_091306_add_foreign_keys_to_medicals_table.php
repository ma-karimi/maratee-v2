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
			$table->foreign('herbarium_application_id')->references('id')->on('herbarium_applications')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('medicine_side_effect_id')->references('id')->on('medicines')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('medicine_drug_id')->references('id')->on('medicines')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('medicine_shape_id')->references('id')->on('medicines')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('medicine_usage_id')->references('id')->on('medicines')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('medicine_effect_id')->references('id')->on('medicines')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('product_id')->references('id')->on('products')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('medicine_therapy_id')->references('id')->on('medicines')->onUpdate('NO ACTION')->onDelete('CASCADE');
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
			$table->dropForeign(['herbarium_application_id']);
			$table->dropForeign(['medicine_side_effect_id']);
			$table->dropForeign(['medicine_drug_id']);
			$table->dropForeign(['medicine_shape_id']);
			$table->dropForeign(['medicine_usage_id']);
			$table->dropForeign(['medicine_effect_id']);
			$table->dropForeign(['product_id']);
			$table->dropForeign(['medicine_therapy_id']);
		});
	}

}
