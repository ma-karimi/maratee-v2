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
            $table->unsignedBigInteger('seed_id')->nullable();

            $table->unsignedBigInteger('station_id')->nullable();
            $table->unsignedBigInteger('replication_or_block_number')->nullable();
            $table->string('observation')->nullable();
            $table->timeStamps();
            $table->softDeletesTz();
            $table->foreign('seed_id')->references('id')->on('seeds')->onUpdate('NO ACTION')->onDelete('CASCADE');

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
