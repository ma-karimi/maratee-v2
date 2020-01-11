<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEvaluationsTable extends Migration
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
        Schema::create('morphology_fields', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->boolean('field_or_greenhouse');
            $table->unsignedBigInteger('location_id');
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
            $table->foreign('location_id')->references('id')->on('locations')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });

        Schema::create('morphology_quantitative_evaluations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('seed_collection_id');
            $table->unsignedBigInteger('specimen_type_id');
            $table->unsignedBigInteger('collection_id');
            $table->unsignedBigInteger('organization_id');
            $table->unsignedBigInteger('project_id');
            $table->string('department_name')->nullable();
            $table->unsignedBigInteger('morphology_field_id')->nullable();
            $table->unsignedBigInteger('replication_or_block_number')->nullable();
            $table->string('plant_density')->nullable();
            $table->string('observation_no')->nullable();
            $table->date('planting_date')->nullable();
            $table->date('observation_date')->nullable();
            $table->integer('days_to_start_flowering')->nullable();
            $table->integer('days_to_flowering')->nullable();
            $table->integer('days_to_seed_ripening')->nullable();
            $table->timeStamps();
            $table->softDeletesTz();
            $table->foreign('seed_collection_id')->references('id')->on('seed_collections')->onUpdate('NO ACTION')->onDelete('CASCADE');

            $table->foreign('specimen_type_id')->references('id')->on('seed_collections')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('collection_id')->references('id')->on('seed_collections')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('organization_id')->references('id')->on('organizations')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('project_id')->references('id')->on('projects')->onUpdate('NO ACTION')->onDelete('CASCADE');

            $table->foreign('morphology_field_id')->references('id')->on('morphology_fields')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });


        Schema::create('morphology_qualitative_evaluations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('seed_collection_id');
            $table->unsignedBigInteger('specimen_type_id');
            $table->unsignedBigInteger('collection_id');
            $table->unsignedBigInteger('organization_id');
            $table->unsignedBigInteger('project_id');
            $table->string('department_name')->nullable();
            $table->unsignedBigInteger('morphology_field_id')->nullable();
            $table->unsignedBigInteger('replication_or_block_number')->nullable();
            $table->string('observation_no')->nullable();
            $table->timeStamps();
            $table->softDeletesTz();
            $table->foreign('seed_collection_id')->references('id')->on('seed_collections')->onUpdate('NO ACTION')->onDelete('CASCADE');

            $table->foreign('morphology_field_id')->references('id')->on('morphology_fields')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });

        Schema::create('morphology_variables', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('seed_general_id');
            $table->morphs('morphology');
            $table->string('value');
            $table->timeStamps();
            $table->softDeletesTz();
            $table->foreign('seed_general_id')->references('id')->on('seed_generals')->onUpdate('NO ACTION')->onDelete('CASCADE');

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
