<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMorphologyQualitativeEvaluationsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('morphology_qualitative_evaluations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('accession_code')->nullable();
            $table->unsignedBigInteger('specimen_type_collect_id')->nullable();
            $table->string('regeneration_and_evaluation_code')->nullable();
            $table->unsignedBigInteger('organization_id');
            $table->unsignedBigInteger('department_id')->nullable();
            $table->unsignedBigInteger('project_id')->nullable();
            $table->string('voucher_no')->nullable();
            $table->unsignedBigInteger('taxonomy_id')->nullable();
            $table->unsignedBigInteger('station_id')->nullable();
            $table->unsignedBigInteger('replication_or_block_number')->nullable();
            $table->string('observation')->nullable();
            $table->timeStampsTz();
            $table->softDeletesTz();
            $table->foreign('specimen_type_collect_id')->references('id')->on('seed_generals')->onUpdate('NO ACTION')->onDelete('CASCADE');
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
        Schema::drop('morphology_qualitative_evaluations');
    }

}
