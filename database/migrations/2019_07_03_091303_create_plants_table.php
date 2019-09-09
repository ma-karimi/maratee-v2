<?php

use App\Libraries\CustomBlueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlantsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('plants', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->json('name');
			$table->json('description')->nullable();
            $table->boolean('is_flowering')->default(0);
            $table->json('life_forms')->comment('life_form_leaf_id', 'life_form_cycle_id', 'life_form_wooden_id', 'life_form_herbaceous_id');
            $table->json('habitat_description')->nullable();
            $table->json('ecology_description')->nullable();
            // $table->unsignedBigInteger('taxonomy_id');
            //$table->unsignedBigInteger('classification_id');
            $table->string('flowering_time')->nullable();
            $table->unsignedBigInteger('protection_id');
            $table->unsignedBigInteger('general_ecology_id')->nullable();
            $table->unsignedBigInteger('general_habitat_id')->nullable();
            $table->unsignedBigInteger('general_origin_id')->nullable();
            $table->unsignedBigInteger('general_phytogeography_id');
            $table->unsignedBigInteger('general_substrate_lichen_id')->nullable();
            $table->unsignedBigInteger('general_substrate_moss_id')->nullable();
            $table->unsignedBigInteger('general_substrate_diatom_id')->nullable();

            $table->timeStampsTz();
            $table->softDeletesTz();
		});
        CustomBlueprint::generatedBigIntegerVirtual('plants','life_form_cycle_id','life_forms','cycle_id',true);
        CustomBlueprint::generatedBigIntegerVirtual('plants','life_form_wooden_id','life_forms','wooden_id',true);
        CustomBlueprint::generatedBigIntegerVirtual('plants','life_form_leaf_id','life_forms','leaf_id',true);
        CustomBlueprint::generatedBigIntegerVirtual('plants','life_form_herbaceous_id','life_forms','herbaceous_id',true);
    }


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('plants');
	}

}
