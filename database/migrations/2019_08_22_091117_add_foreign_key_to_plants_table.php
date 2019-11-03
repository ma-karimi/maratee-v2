<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyToPlantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plants', function (Blueprint $table) {
            $table->foreign('general_ecology_id')->references('id')->on('generals')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('general_habitat_id')->references('id')->on('generals')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('general_origin_id')->references('id')->on('generals')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('general_phytogeography_id')->references('id')->on('generals')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('general_substrate_lichen_id')->references('id')->on('generals')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('general_substrate_moss_id')->references('id')->on('generals')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('general_substrate_diatom_id')->references('id')->on('generals')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('protection_id')->references('id')->on('protections')->onUpdate('NO ACTION')->onDelete('CASCADE');
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
        Schema::table('plants', function (Blueprint $table) {
            $table->dropForeign('protection_id');
            $table->dropForeign('general_ecology_id');
            $table->dropForeign('general_habitat_id');
            $table->dropForeign('general_origin_id');
            $table->dropForeign('general_phytogeography_id');
            $table->dropForeign('general_substrate_lichen_id');
            $table->dropForeign('general_substrate_moss_id');
            $table->dropForeign('general_substrate_diatom_id');
            $table->dropForeign('taxonomy_id');
            $table->dropForeign('cycle_id');
            $table->dropForeign('wooden_id');
            $table->dropForeign('herbaceous_id');
        });
    }
}
