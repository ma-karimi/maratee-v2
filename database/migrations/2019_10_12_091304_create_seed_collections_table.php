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
            $table->unsignedBigInteger('taxonomy_id');
            $table->string('encoded_code_by_collector')->nullable();
            $table->string('corrected_code_by_nrgb')->nullable();
            $table->string('accession_code')->nullable();
            $table->string('voucher_no')->nullable();
            $table->unsignedBigInteger('organization_id');
            $table->string('department_or_group')->nullable();
            $table->unsignedBigInteger('project_id')->nullable();
            $table->unsignedBigInteger('location_id');
            $table->unsignedBigInteger('land_form_id')->nullable();
            $table->unsignedBigInteger('slope_aspect_id')->nullable();
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
            $table->string('associated_species')->nullable();
            $table->unsignedBigInteger('soil_erosion_id')->nullable();
            $table->integer('area_sampled')->nullable();
            $table->integer('plants_sampled_no')->nullable();
            $table->integer('approximate_area_of_plant')->nullable();
            $table->unsignedBigInteger('specimen_type_collect_id');
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
            $table->timeStamps();
            $table->softDeletesTz();

            $table->foreign('seed_id')->references('id')->on('seeds')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('location_id')->references('id')->on('locations')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('slope_aspect_id')->references('id')->on('seed_generals')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('general_habitat_id')->references('id')->on('generals')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('soil_depth_id')->references('id')->on('seed_generals')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('soil_texture_id')->references('id')->on('seed_generals')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('drainage_id')->references('id')->on('seed_generals')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('soil_salinity_id')->references('id')->on('seed_generals')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('soil_lime_id')->references('id')->on('seed_generals')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('soil_erosion_id')->references('id')->on('seed_generals')->onUpdate('NO ACTION')->onDelete('cascade');
//            $table->foreign('specimen_type_id')->references('id')->on('seed_generals')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('pollination_type_id')->references('id')->on('seed_generals')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('pollination_agent_id')->references('id')->on('seed_generals')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('fruit_type_id')->references('id')->on('seed_generals')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('seed_collected_from_id')->references('id')->on('seed_generals')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('life_form_id')->references('id')->on('seed_generals')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('growth_form_id')->references('id')->on('seed_generals')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('plant_mother_health_id')->references('id')->on('seed_generals')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('plant_consumption_value_id')->references('id')->on('seed_generals')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('general_used_part_id')->references('id')->on('seed_generals')->onUpdate('NO ACTION')->onDelete('cascade');
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
