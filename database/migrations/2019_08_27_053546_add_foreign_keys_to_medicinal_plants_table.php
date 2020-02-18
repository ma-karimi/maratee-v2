<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMedicinalPlantsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('medicinal_plants', function(Blueprint $table)
		{
			$table->foreign('aerial_part_id')->references('id')->on('medicinal_parts')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('ground_part_id')->references('id')->on('medicinal_parts')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('food_industry_id')->references('id')->on('medicinal_plant_types')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('hygienic_cosmetic_industry_id')->references('id')->on('medicinal_plant_types')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('other_industry_id')->references('id')->on('medicinal_plant_types')->onUpdate('NO ACTION')->onDelete('CASCADE');
//			$table->foreign('industrial_potential_id')->references('id')->on('medicinal_plant_types')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('method_distillation_id')->references('id')->on('methods')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('method_extraction_id')->references('id')->on('methods')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('method_analyse_id')->references('id')->on('methods')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('secondary_metabolite_id')->references('id')->on('medicinal_plant_types')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('effective_material_id')->references('id')->on('medicinal_plant_types')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('pharmaceutical_form_id')->references('id')->on('medicinal_plant_types')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('product_id')->references('id')->on('products')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('medicine_id')->references('id')->on('medicines')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('treatment_id')->references('id')->on('treatments')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('general_habitat_id')->references('id')->on('generals')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('cycle_id')->references('id')->on('life_forms')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('wooden_id')->references('id')->on('life_forms')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('herbaceous_id')->references('id')->on('life_forms')->onUpdate('NO ACTION')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
    public function down()
    {
        Schema::table('medicinal_plants', function (Blueprint $table) {
            $table->dropForeign(['aerial_part_id']);
            $table->dropForeign(['ground_part_id']);
            $table->dropForeign(['food_industry_id']);
            $table->dropForeign(['hygienic_cosmetic_industry_id']);
//            $table->dropForeign(['industrial_potential_id']);
            $table->dropForeign(['method_distillation_id']);
            $table->dropForeign(['method_extraction_id']);
            $table->dropForeign(['method_analyse_id']);
            $table->dropForeign(['secondary_metabolite_id']);
            $table->dropForeign(['effective_material_id']);
            $table->dropForeign(['pharmaceutical_form_id']);
            $table->dropForeign(['product_id']);
            $table->dropForeign(['medicine_id']);
            $table->dropForeign(['treatment_id']);
            $table->dropForeign(['general_habitat_id']);
            $table->dropForeign(['cycle_id']);
            $table->dropForeign(['wooden_id']);
            $table->dropForeign(['herbaceous_id']);
        });
    }

}
