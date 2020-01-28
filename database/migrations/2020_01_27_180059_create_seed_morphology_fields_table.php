<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSeedMorphologyFieldsTable extends Migration
{


    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('morphology_qualitative_evaluation_vars');
        Schema::dropIfExists('morphology_quantitative_evaluation_vars');
        Schema::dropIfExists('morphology_quantitative_evaluations');
        Schema::dropIfExists('morphology_qualitative_evaluations');
        Schema::dropIfExists('morphology_fields');
        Schema::dropIfExists('stations');
        Schema::create('seed_morphology_fields', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('green_house_id');
            $table->unsignedBigInteger('seed_morphology_id');
            $table->string('soil_ph')->nullable();
            $table->string('soil_ec')->nullable()->comment('ds/m');
            $table->string('soil_depth')->nullable()->comment('cm');
            $table->string('sand')->nullable()->comment('%');
            $table->string('loam')->nullable()->comment('%');
            $table->string('clay')->nullable()->comment('%');
            $table->string('soil_texture')->nullable()->comment('%');
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
            $table->timeStamps();
            $table->softDeletesTz();
            $table->foreign('green_house_id')->references('id')->on('green_houses')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('seed_morphology_id')->references('id')->on('seed_morphologies')->onUpdate('NO ACTION')->onDelete('CASCADE');
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
