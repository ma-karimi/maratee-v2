<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTechnologiesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('technologies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('seed_technology_id');
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('seed_id');
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('evaluation_id');
            $table->unsignedBigInteger('germination_id');
            $table->unsignedBigInteger('seed_weight_id');
            $table->integer('fridge_type')->nullable();
            $table->string('regeneration_evaluation')->nullable();

            $table->timeStampsTz();
            $table->softDeletesTz();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('technologies');
    }

}
