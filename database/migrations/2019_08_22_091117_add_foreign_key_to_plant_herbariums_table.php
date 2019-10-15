<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyToPlantHerbariumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plant_herbariums', function (Blueprint $table) {
            $table->foreign('general_ecology_id')->references('id')->on('generals')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('general_habitat_id')->references('id')->on('generals')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('general_origin_id')->references('id')->on('generals')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('general_phytogeography_id')->references('id')->on('generals')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('general_substrate_lichen_id')->references('id')->on('generals')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('general_substrate_moss_id')->references('id')->on('generals')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('general_substrate_diatom_id')->references('id')->on('generals')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('organization_id')->references('id')->on('organizations')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('protection_id')->references('id')->on('protections')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('location_id')->references('id')->on('locations')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('taxonomy_id')->references('id')->on('taxonomies')->onUpdate('NO ACTION')->onDelete('CASCADE');
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
        Schema::table('plant_herbariums', function (Blueprint $table) {
            $table->dropForeign('protection_id');
            $table->dropForeign('general_ecology_id');
            $table->dropForeign('general_habitat_id');
            $table->dropForeign('general_origin_id');
            $table->dropForeign('general_phytogeography_id');
            $table->dropForeign('general_substrate_lichen_id');
            $table->dropForeign('general_substrate_moss_id');
            $table->dropForeign('general_substrate_diatom_id');
            $table->dropForeign('organization_id');
            $table->dropForeign('cycle_id');
            $table->dropForeign('wooden_id');
            $table->dropForeign('herbaceous_id');
        });
    }
}
