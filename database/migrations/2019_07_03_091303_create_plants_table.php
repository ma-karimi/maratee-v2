<?php

use App\Libraries\CustomBlueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlantsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('number')->nullable();
            $table->unsignedBigInteger('taxonomy_id');
            $table->boolean('monopoly_of_iran_id')->nullable();

//            $table->integer('sheets_no')->nullable()->comment('Number of required sheets per herbarium sample');
//            $table->integer('samples_no')->nullable()->comment('Quantity of samples of each herbarium number');
//            $table->integer('tip_qt')->nullable()->comment('number of tips
//if tip_qt > 0, it meant we have the tip herbarium, otherwise means we don\'t have any tips related to this herbarium number');
//            $table->integer('physical_tip_qt')->nullable()->comment('it means how many physical tips we have.
//if it is equal to zero, it means we don\'t have any physical tip and if tip_qt >0, it means we have image tips, rather than physical tips.');
            $table->text('description')->nullable();
//            $table->boolean('is_flowering')->default(0);
            //$table->json('life_forms')->comment('life_form_leaf_id, life_form_cycle_id, life_form_wooden_id, life_form_herbaceous_id')->nullable();
            $table->text('habitat_description')->nullable();
            $table->text('ecology_description')->nullable();
            $table->string('flowering_time')->nullable();

            $table->unsignedBigInteger('protection_id')->nullable();
            $table->unsignedBigInteger('general_ecology_id')->nullable();
            $table->unsignedBigInteger('general_habitat_id')->nullable();
            $table->unsignedBigInteger('general_origin_id')->nullable();
            $table->unsignedBigInteger('general_phytogeography_id')->nullable();
            $table->unsignedBigInteger('general_substrate_lichen_id')->nullable();
            $table->unsignedBigInteger('general_substrate_moss_id')->nullable();
            $table->unsignedBigInteger('general_substrate_diatom_id')->nullable();

            $table->unsignedBigInteger('cycle_id')->nullable();
            $table->unsignedBigInteger('wooden_id')->nullable();
            $table->unsignedBigInteger('herbaceous_id')->nullable();

            $table->timeStamps();
            $table->softDeletesTz();
        });
        //for MYSQL OR MariaDB
       // CustomBlueprint::generatedVirtual('plants', 'life_form_cycle_id', 'life_forms', 'cycle_id', true);
       // CustomBlueprint::generatedVirtual('plants', 'life_form_wooden_id', 'life_forms', 'wooden_id', true);
       // CustomBlueprint::generatedVirtual('plants', 'life_form_herbaceous_id', 'life_forms', 'herbaceous_id', true);
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('plants');
    }

}
