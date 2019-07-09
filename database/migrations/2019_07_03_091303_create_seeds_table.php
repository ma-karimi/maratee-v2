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
            $table->increments('id');
            $table->unsignedInteger('herbarium_id');
            $table->unsignedInteger('protection_id');
            $table->integer('field_code')->nullable();
            $table->string('correct_field_code', 45)->nullable();
            $table->integer('sample_code')->nullable();
            $table->integer('voucher_no')->nullable();
            $table->json('transmittance')->nullable();
            $table->json('land_form')->nullable();
            $table->json('slope_direction')->nullable();
            $table->json('landscape')->nullable();
            $table->integer('slope_degree')->nullable();
            $table->json('soil_depth')->nullable();
            $table->json('density')->nullable();
            $table->json('drainage')->nullable();
            $table->json('soil_ph')->nullable();
            $table->json('salinity')->nullable();
            $table->json('lime')->nullable();
            $table->json('climate')->nullable();
            $table->json('extent_population')->nullable();
            $table->json('vegetation')->nullable();
            $table->json('soil_erosion')->nullable();
            $table->json('land_reforming')->nullable();
            $table->json('sample_type')->nullable();
            $table->json('flowering')->nullable();
            $table->json('pollination')->nullable();
            $table->json('pollination_agent')->nullable();
            $table->json('fruit_type')->nullable();
            $table->integer('seeding_bush_qt')->nullable();
            $table->json('collecting_type')->nullable();
            $table->json('seeding_month')->nullable();
            $table->json('reproduction')->nullable();
            $table->json('vegetative_form')->nullable();
            $table->integer('height')->nullable();
            $table->json('mother_health')->nullable();
            $table->unsignedInteger('department_id');
            $table->date('send_date')->nullable();
            $table->integer('collected_qt')->nullable();
            $table->integer('must_collected_qt')->nullable();
            $table->integer('critical_extensions_qt')->nullable();
            $table->json('notes')->nullable();

            $table->timeStampsTz();
            $table->dateTimeTz('deleted_at')->nullable();
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
