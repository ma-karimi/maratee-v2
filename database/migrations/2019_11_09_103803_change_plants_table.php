<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class ChangePlantsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('plant_life_forms');
        Schema::dropIfExists('plant_properties');
        Schema::table('plants', function (Blueprint $table) {

            $table->dropForeign(['general_ecology_id']);
            $table->dropForeign(['cycle_id']);
            $table->dropForeign(['wooden_id']);
            $table->dropForeign(['herbaceous_id']);
            $table->dropColumn(['general_ecology_id', 'cycle_id', 'wooden_id', 'herbaceous_id']);

//            $table->dropColumn(['general_ecology_id']);
//            $table->dropColumn(['cycle_id']);
//            $table->dropColumn(['wooden_id']);
//            $table->dropColumn(['herbaceous_id']);
            $table->tinyInteger('life_form_id')->nullable()->comment('1=> annual, 2=>perennial , 3=>tree , 4=>shrubs');
            $table->string('n_no')->nullable();
            $table->string('n2_no')->nullable();
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
