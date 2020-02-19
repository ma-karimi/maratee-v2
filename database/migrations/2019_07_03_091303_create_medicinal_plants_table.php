<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMedicinalPlantsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicinal_plants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('taxonomy_id');

            $table->boolean('hygienic_cosmetic_industry_id')->default(0)->change();
            $table->boolean('cultivated_area_id')->default(0);
            $table->unsignedBigInteger('aerial_part_id')->nullable();
            $table->unsignedBigInteger('ground_part_id')->nullable();
            $table->unsignedBigInteger('food_industry_id')->nullable();
            $table->unsignedBigInteger('general_origin_id')->nullable();
            $table->unsignedBigInteger('hygienic_cosmetic_industry_id')->nullable();
            $table->unsignedBigInteger('other_industry_id')->nullable()->comment('now');
            $table->unsignedBigInteger('industrial_potential_id')->nullable()->comment('other industrial in future');
            $table->unsignedBigInteger('phenology_id')->nullable()->comment('from medicinal_plant_types');
            $table->unsignedBigInteger('method_distillation_id')->nullable();
            $table->unsignedBigInteger('method_extraction_id')->nullable();
            $table->unsignedBigInteger('method_analyse_id')->nullable();
            $table->unsignedBigInteger('secondary_metabolite_id')->nullable()->comment('from medicinal_plant_types');
            $table->unsignedBigInteger('pharmaceutical_form_id')->nullable()->comment('from medicinal_plant_types');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->tinyInteger('traditional_iranian_medicine')->comment('0:unknown, 1:raw, 2: processed')->default(0);
            $table->tinyInteger('natural_drug')->comment('0:unknown, 1:Human medicines, 2: Animal drugs')->default(0);
            $table->tinyInteger('inherbal_medicine_store')->comment('0:unknown, 1:raw, 2: processed')->default(0);
            $table->tinyInteger('exporting')->comment('0:unknown, 1:raw, 2: processed')->default(0);
            $table->tinyInteger('importing')->comment('0:unknown, 1:raw, 2: processed')->default(0);
            $table->tinyInteger('cultivated_area')->comment('0:unknown, 1:raw, 2: processed')->default(0);
            $table->tinyInteger('studied_sample')->comment('0:unknown, 1:wild, 2: cultivated')->default(0);
            $table->tinyInteger('presence_in_country')->comment('0:unknown, 1:native, 2: endemic')->default(0);
            $table->text('medicinal_properties')->nullable();
            $table->text('side_effects')->nullable();
            $table->unsignedBigInteger('medicine_id')->nullable();
            $table->unsignedBigInteger('treatment_id')->nullable();

            $table->float('efficiency', 4, 2)->nullable();
            $table->integer('code_no')->nullable();
            //morphology
            $table->unsignedBigInteger('general_habitat_id')->nullable();

            $table->string('fruit_color')->nullable();
            $table->string('foliage_color')->nullable();
            $table->string('flower_color')->nullable();
            $table->string('height')->nullable()->comment('unit: cm');
            $table->unsignedBigInteger('cycle_id')->nullable();
            $table->unsignedBigInteger('wooden_id')->nullable();
            $table->unsignedBigInteger('herbaceous_id')->nullable();

            $table->timeStamps();
            $table->softDeletesTz();
            });
        //for MYSQL OR MariaDB
       //  CustomBlueprint::generatedVirtual('medicinal_plants', 'life_form_cycle_id', 'life_forms', 'cycle_id', true);
        //  CustomBlueprint::generatedVirtual('medicinal_plants', 'life_form_wooden_id', 'life_forms', 'wooden_id', true);
        // CustomBlueprint::generatedVirtual('medicinal_plants', 'life_form_herbaceous_id', 'life_forms', 'herbaceous_id', true);
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
