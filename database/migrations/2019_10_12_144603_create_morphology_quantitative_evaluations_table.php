<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMorphologyQuantitativeEvaluationsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('morphology_quantitative_evaluations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('accession_code')->nullable();
            $table->unsignedBigInteger('collect_id')->comment('specimen_type_collect_id')->nullable();
            $table->string('regeneration_and_evaluation_code')->nullable();
            $table->unsignedBigInteger('organization_id');
            $table->unsignedBigInteger('department_id')->nullable();
            $table->unsignedBigInteger('project_id')->nullable();
            $table->string('voucher_no')->nullable();
            $table->unsignedBigInteger('taxonomy_id')->nullable();
            $table->unsignedBigInteger('station_id')->nullable();
            $table->unsignedBigInteger('replication_or_block_number')->nullable();
            $table->string('plant_density')->nullable()->comment('per hectare');
            $table->string('observation')->nullable();
            $table->date('planting_date')->nullable();
            $table->date('date_of_observation')->nullable();
            $table->integer('days_of_start_flowering')->nullable();
            $table->integer('days_to_flowering')->nullable();
            $table->integer('days_to_seed_ripening')->nullable();
            $table->timeStampsTz();
            $table->softDeletesTz();
            $table->foreign('collect_id')->references('id')->on('seed_generals')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('organization_id')->references('id')->on('organizations')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('department_id')->references('id')->on('departments')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('project_id')->references('id')->on('projects')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('taxonomy_id')->references('id')->on('taxonomies')->onUpdate('NO ACTION')->onDelete('CASCADE');
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
        Schema::drop('morphology_quantitative_evaluations');
    }

}
