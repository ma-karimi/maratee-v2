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
            $table->unsignedBigInteger('seed_id')->nullable();

            $table->unsignedBigInteger('station_id')->nullable();
            $table->unsignedBigInteger('replication_or_block_number')->nullable();
            $table->string('plant_density')->nullable()->comment('per hectare');
            $table->string('observation')->nullable();
            $table->date('planting_date')->nullable();
            $table->date('date_of_observation')->nullable();
            $table->integer('days_of_start_flowering')->nullable();
            $table->integer('days_to_flowering')->nullable();
            $table->integer('days_to_seed_ripening')->nullable();
            $table->timeStamps();
            $table->softDeletesTz();

            $table->foreign('station_id')->references('id')->on('stations')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('seed_id')->references('id')->on('seeds')->onUpdate('NO ACTION')->onDelete('CASCADE');
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
