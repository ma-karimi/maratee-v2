<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMedicinalPlantsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicinal_plants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('taxonomy_id');
            $table->unsignedBigInteger('ground_part_id')->nullable();
            $table->unsignedBigInteger('general_origin_id')->nullable();
            $table->unsignedBigInteger('wooden_id')->nullable();
            $table->text('properties_description')->nullable();
            $table->text('compounds')->nullable();

            $table->timeStamps();
            $table->softDeletesTz();
            });
        //for MYSQL OR MariaDB
       //  CustomBlueprint::generatedVirtual('medicinal_plants', 'life_form_cycle_id', 'life_forms', 'cycle_id', true);
        //  CustomBlueprint::generatedVirtual('medicinal_plants', 'life_form_wooden_id', 'life_forms', 'wooden_id', true);
        // CustomBlueprint::generatedVirtual('medicinal_plants', 'life_form_herbaceous_id', 'life_forms', 'herbaceous_id', true);
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('medicinal_plants');
    }

}
