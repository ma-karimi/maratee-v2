<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class ChangeSubstratePlantsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plants', function (Blueprint $table) {

            $table->dropForeign(['general_substrate_lichen_id']);
            $table->dropForeign(['general_substrate_moss_id']);
            $table->dropForeign(['general_substrate_diatom_id']);
            $table->dropColumn(['general_substrate_lichen_id', 'general_substrate_moss_id', 'general_substrate_diatom_id']);

            $table->tinyInteger('general_substrate_id')->nullable();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }

}
