<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBiochemicalEvaluationVarsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biochemical_evaluation_vars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('biochemical_evaluation_id');
            $table->tinyInteger('var_id')->default(1);
            $table->string('value');
            $table->timeStampsTz();
            $table->softDeletesTz();
            $table->foreign('biochemical_evaluation_id')->references('id')->on('biochemical_evaluations')->onUpdate('NO ACTION')->onDelete('CASCADE');

        });


    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('biochemical_evaluation_vars');
    }

}
