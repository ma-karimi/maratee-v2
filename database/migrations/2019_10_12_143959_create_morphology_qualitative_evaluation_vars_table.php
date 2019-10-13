<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMorphologyQualitativeEvaluationVarsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('morphology_qualitative_evaluation_vars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('morphology_qualitative_evaluation_id');
            $table->tinyInteger('var_id')->default(1);
            $table->string('value');
            $table->timeStampsTz();
            $table->softDeletesTz();
            $table->foreign('morphology_qualitative_evaluation_id')->references('id')->on('morphology_qualitative_evaluations')->onUpdate('NO ACTION')->onDelete('CASCADE');

        });


    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('morphology_qualitative_evaluation_vars');
    }

}
