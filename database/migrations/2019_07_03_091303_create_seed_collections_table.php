<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSeedCollectionsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seed_collections', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('voucher_no')->nullable();
            $table->unsignedBigInteger('taxonomy_id');
            $table->unsignedBigInteger('organization_id');
            $table->unsignedBigInteger('department_id')->nullable();
            $table->unsignedBigInteger('project_id')->nullable();
            $table->string('encoded_code_by_collector')->nullable();
            $table->string('corrected_code_by_nrgb')->nullable();
            $table->string('accession_released_code_by_nrgb')->nullable();
            $table->unsignedBigInteger('location_id');
            $table->unsignedBigInteger('land_form_id')->nullable();
            $table->unsignedBigInteger('slope_aspect')->nullable();
            $table->string('slope_degree')->nullable();
            $table->unsignedBigInteger('general_habitat_id')->nullable();
            $table->unsignedBigInteger('soil_depth_id')->nullable();
            $table->unsignedBigInteger('soil_texture_id')->nullable();
            $table->unsignedBigInteger('drainage_id')->nullable();
            $table->string('soil_ph')->nullable();
            $table->unsignedBigInteger('soil_salinity_id')->nullable();
            $table->unsignedBigInteger('soil_lime_id')->nullable();
            $table->string('climate')->nullable();
            $table->string('community_type')->nullable();
            $table->unsignedBigInteger('soil_erosion_id')->nullable();
            $table->integer('area_sampled')->nullable();
            $table->integer('plants_sampled_no')->nullable();
            $table->integer('approximate_area_of_plant')->nullable();
            $table->unsignedBigInteger('specimen_type_id')->nullable();
            $table->tinyInteger('flowering_time_id')->nullable();
            $table->unsignedBigInteger('pollination_type_id')->nullable();
            $table->unsignedBigInteger('pollination_agent_id')->nullable();
            $table->unsignedBigInteger('fruit_type_id')->nullable();
            $table->unsignedBigInteger('seed_collected_from_id')->nullable();
            $table->tinyInteger('date_harvesting_id')->nullable();
            $table->unsignedBigInteger('life_form_id')->nullable();
            $table->unsignedBigInteger('growth_form_id')->nullable();
            $table->integer('plant_height')->nullable();
            $table->unsignedBigInteger('plant_mother_health_id')->nullable();
            $table->unsignedBigInteger('plant_consumption_value_id');
            $table->unsignedBigInteger('general_used_part_id');
            $table->string('how_to_use')->nullable();
            $table->string('other_details')->nullable();
            $table->string('special_advise')->nullable();
            $table->timeStampsTz();
            $table->softDeletesTz();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('seed_collections');
    }

}
