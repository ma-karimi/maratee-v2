<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMorphologyQuantitativeEvaluationVarsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('morphology_quantitative_evaluation_vars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('morphology_quantitative_evaluation_id');
            $table->tinyInteger('var_id')->default(1);
            $table->string('value');
            $table->timeStampsTz();
            $table->softDeletesTz();
            $table->foreign('morphology_quantitative_evaluation_id')->references('id')->on('morphology_quantitative_evaluations')->onUpdate('NO ACTION')->onDelete('CASCADE');

        });


    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('morphology_quantitative_evaluation_vars');
    }

}
