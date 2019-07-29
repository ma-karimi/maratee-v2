<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeHerbariumRelatedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('herbariums', function (Blueprint $table) {
            $table->dropForeign(['plant_type_id']);
            $table->dropForeign(['plant_group_id']);
            $table->dropForeign(['phenology_id']);
            $table->renameColumn('phenology_id', 'plantologies_phenology_id');
            $table->renameColumn('plant_type_id', 'plantologies_type_id');
            $table->renameColumn('plant_group_id', 'plant_generals_group_id');
            $table->renameColumn('phytogeography_id', 'plantologies_phytogeography_id');


            $table->foreign('plant_generals_group_id')->references('id')->on('plant_generals')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('plantologies_type_id')->references('id')->on('plantologies')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('plantologies_phenology_id')->references('id')->on('plantologies')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('plantologies_phytogeography_id')->references('id')->on('plantologies')->onUpdate('NO ACTION')->onDelete('NO ACTION');

            $table->unsignedInteger('plant_id');
            $table->foreign('plant_id')->references('id')->on('plants')->onUpdate('NO ACTION')->onDelete('NO ACTION');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('herbariums', function (Blueprint $table) {
            $table->dropForeign(['plantologies_phytogeography_id']);
            $table->dropForeign(['plantologies_phenology_id']);
            $table->dropForeign(['plantologies_type_id']);
            $table->dropForeign(['plant_generals_group_id']);
            $table->renameColumn('plantologies_phytogeography_id', 'phytogeography_id');
            $table->renameColumn('plantologies_phenology_id', 'phenology_id');
            $table->renameColumn('plantologies_type_id', 'plant_type_id');
            $table->renameColumn('plant_generals_group_id', 'plant_group_id');
            $table->foreign('phenology_id')->references('id')->on('plantologies')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('plant_group_id')->references('id')->on('plant_generals')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('plant_type_id')->references('id')->on('plantologies')->onUpdate('NO ACTION')->onDelete('NO ACTION');

            $table->dropForeign(['plant_id']);
            $table->dropColumn('plant_id');

        });
    }
}
