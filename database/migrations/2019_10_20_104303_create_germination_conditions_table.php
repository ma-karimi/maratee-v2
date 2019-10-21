<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGerminationConditionsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('germination_conditions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('seed_id');
            $table->date('light')->nullable();
            $table->date('dark')->nullable();
            $table->string('light_degree')->nullable()->comment('°C');
            $table->string('dark_degree')->nullable()->comment('°C');
            $table->tinyInteger('dormancy_termination')->nullable();
            $table->tinyInteger('germination_period')->nullable();
            $table->timeStamps();
            $table->softDeletesTz();
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
        Schema::drop('germination_conditions');
    }

}
