<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMorphologyFieldOrGreenhousesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('morphology_field_or_greenhouses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('station_id');
            $table->unsignedBigInteger('field_or_greenhouse');
            $table->unsignedBigInteger('location_id');
            $table->string('soil_ph')->nullable();
            $table->string('soil_ec')->nullable()->comment('ds/m');
            $table->string('soil_depth')->nullable()->comment('cm');
            $table->string('sand')->nullable()->comment('%');
            $table->string('loam')->nullable()->comment('%');
            $table->string('clay')->nullable()->comment('%');
            $table->unsignedBigInteger('collect_id')->comment('specimen_type_collect_id')->nullable();
            $table->string('n')->nullable()->comment('%');
            $table->string('p')->nullable()->comment('%');
            $table->string('k')->nullable()->comment('%');
            $table->string('soil_organic_matter')->nullable()->comment('%');
            $table->string('source_of_water')->nullable();
            $table->string('irrigation_system')->nullable();
            $table->string('irrigation_circuit')->nullable();
            $table->string('irrigation_time')->nullable();
            $table->string('flow_rate')->nullable()->comment('l/h');
            $table->string('water')->nullable()->comment('ph');
            $table->string('water_ec')->nullable()->comment('ds/m');
            $table->string('meteorological_station_data')->nullable()->comment('excel file');
            $table->timeStampsTz();
            $table->softDeletesTz();
            $table->foreign('collect_id')->references('id')->on('seed_generals')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('location_id')->references('id')->on('locations')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('station_id')->references('id')->on('stations')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });


    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('morphology_field_or_greenhouses');
    }

}
