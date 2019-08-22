<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSeedsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seeds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('herbarium_id');
            $table->unsignedBigInteger('collection_id');
            $table->unsignedBigInteger('protection_id');
            $table->string('field_code')->nullable();
            $table->string('correct_field_code')->nullable();
            $table->string('accession_code')->nullable();
            $table->string('voucher_no')->nullable();
            $table->json('transmittance')->nullable();
            $table->json('land_form')->nullable();
            $table->json('slope_action')->nullable();
            $table->json('landscape')->nullable();
            $table->integer('slope_degree')->nullable();
            $table->json('soil_depth')->nullable();
            $table->json('soil_texture')->nullable();
            $table->json('drainage')->nullable();
            $table->json('soil_ph')->nullable();
            $table->json('salinity')->nullable();
            $table->json('lime')->nullable();
            $table->json('climate')->nullable();
            $table->json('community_type')->nullable();
            $table->json('associated_species')->nullable();
            $table->json('soil_erosion')->nullable();
            $table->integer('area_sampled')->nullable();
            $table->json('specimen_type')->nullable();
            $table->string('date_flowering')->nullable();
            $table->json('pollination_type')->nullable();
            $table->json('pollination_agent')->nullable();
            $table->json('fruit_type')->nullable();
            $table->string('seed_collected_from')->nullable();
            $table->string('date_harvesting')->nullable();
            $table->string('life_span')->nullable();
            $table->string('growth_form')->nullable();
            $table->integer('plant_height')->nullable();
            $table->json('mother_health')->nullable();
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('plant_application_id');
            $table->json('other_detail')->nullable();
            $table->integer('plants_sampled_no')->nullable();
            $table->integer('plants_found_no')->nullable();
            $table->json('seed_advise')->nullable();
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
        Schema::drop('seeds');
    }

}
