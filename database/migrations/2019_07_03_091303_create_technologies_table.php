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
            $table->increments('id');
            $table->unsignedInteger('seed_technology_id');
            $table->unsignedInteger('project_id');
            $table->unsignedInteger('seed_id');
            $table->unsignedInteger('department_id');
            $table->unsignedInteger('evaluation_id');
            $table->unsignedInteger('germination_id');
            $table->unsignedInteger('seed_weight_id');
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
