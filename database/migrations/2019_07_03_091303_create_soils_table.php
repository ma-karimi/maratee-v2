<?php

use App\Libraries\CustomBlueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSoilsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('soils', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->tinyInteger('ph_type_id')->comment('neutral-alkaline-acid-indifferent');
			$table->json('features')->comment('clay soil%-loam%-fine sand%-coarse sand%- gravel%-shale%-salt%-gypsum%-forest soil%peat%-compost%-manure%-bone powder%');
			$table->json('description')->nullable();
            $table->timeStampsTz();
            $table->softDeletesTz();
		});
        CustomBlueprint::generatedVirtual('soils','clay_feature','features','clay_feature',false,'DOUBLE');
        CustomBlueprint::generatedVirtual('soils','loam_feature','features','loam_feature',false,'DOUBLE');
        CustomBlueprint::generatedVirtual('soils','fine_sand_feature','features','fine_sand_feature',false,'DOUBLE');
        CustomBlueprint::generatedVirtual('soils','coarse_sand_feature','features','coarse_sand_feature',false,'DOUBLE');
        CustomBlueprint::generatedVirtual('soils','gravel_feature','features','gravel_feature',false,'DOUBLE');
        CustomBlueprint::generatedVirtual('soils','shale_feature','features','shale_feature',false,'DOUBLE');
        CustomBlueprint::generatedVirtual('soils','salt_feature','features','salt_feature',false,'DOUBLE');
        CustomBlueprint::generatedVirtual('soils','gypsum_feature','features','gypsum_feature',false,'DOUBLE');
        CustomBlueprint::generatedVirtual('soils','peat_feature','features','peat_feature',false,'DOUBLE');
        CustomBlueprint::generatedVirtual('soils','compost_feature','features','compost_feature',false,'DOUBLE');
        CustomBlueprint::generatedVirtual('soils','manure_feature','features','manure_feature',false,'DOUBLE');
        CustomBlueprint::generatedVirtual('soils','bone_powder_feature','features','bone_powder_feature',false,'DOUBLE');
    }


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('soils');
	}

}
