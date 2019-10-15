<?php

use App\Libraries\CustomBlueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSoilsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soils', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('ph_type_id')->comment('neutral-alkaline-acid-indifferent');
            $table->json('features')->comment('clay soil%-loam%-fine sand%-coarse sand%- gravel%-shale%-salt%-gypsum%-forest soil%peat%-compost%-manure%-bone powder%');
            $table->json('description')->nullable();
            $table->timeStamps();
            $table->softDeletesTz();
        });
        $generated_columns = [
            'clay_feature',
            'loam_feature',
            'fine_sand_feature',
            'coarse_sand_feature',
            'gravel_feature',
            'shale_feature',
            'salt_feature',
            'gypsum_feature',
            'peat_feature',
            'compost_feature',
            'manure_feature',
            'bone_powder_feature',
        ];
        foreach ($generated_columns as $index => $generated_column) {
            CustomBlueprint::generatedVirtual('soils', $generated_column, 'features', $generated_column, false, 'DOUBLE');
        }
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
