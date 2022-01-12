<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMedicinalPlantsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medicinal_plants', function (Blueprint $table) {
//            $table->foreign('aerial_part_id')->references('id')->on('medicinal_parts')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('ground_part_id')->references('id')->on('medicinal_parts')->onUpdate('NO ACTION')->onDelete('CASCADE');

//            $table->foreign('general_habitat_id')->references('id')->on('generals')->onUpdate('NO ACTION')->onDelete('CASCADE');
//            $table->foreign('cycle_id')->references('id')->on('life_forms')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('wooden_id')->references('id')->on('life_forms')->onUpdate('NO ACTION')->onDelete('CASCADE');
//            $table->foreign('herbaceous_id')->references('id')->on('life_forms')->onUpdate('NO ACTION')->onDelete('CASCADE');
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
            $table->dropForeign(['general_habitat_id']);
            $table->dropForeign(['cycle_id']);
            $table->dropForeign(['wooden_id']);
            $table->dropForeign(['herbaceous_id']);
        });
    }

}
