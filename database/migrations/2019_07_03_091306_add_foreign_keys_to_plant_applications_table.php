<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPlantApplicationsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plant_applications', function (Blueprint $table) {
            $table->foreign('plant_factor_application_id')->references('id')->on('plant_factors')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('herbarium_id')->references('id')->on('herbariums')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('plant_factor_growth_id')->references('id')->on('plant_factors')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('plant_factor_industry_id')->references('id')->on('plant_factors')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('plant_factor_part_id')->references('id')->on('plant_factors')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('plant_factor_usage_type_id')->references('id')->on('plant_factors')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public
    function down()
    {
        Schema::table('plant_applications', function (Blueprint $table) {
            $table->dropForeign(['herbarium_id']);
            $table->dropForeign(['plant_factor_part_id']);
            $table->dropForeign(['plant_factor_application_id']);
            $table->dropForeign(['plant_factor_growth_id']);
            $table->dropForeign(['plant_factor_usage_type_id']);
            $table->dropForeign(['plant_factor_industry_id']);
        });
    }

}
