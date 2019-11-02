<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBotanicalIrrigationsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('botanical_irrigations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('botanical_id');
            $table->unsignedBigInteger('irrigation_id');
            $table->tinyInteger('requirement')->comment('sparse-moderate-heavy');
            $table->tinyInteger('appropriate_irrigation_time')->comment('morning-day-evening-night- 0:indifferent')->default(0);
            //irrigation_time
            $table->string('spring_time')->nullable();
            $table->string('summer_time')->nullable();
            $table->string('autumn_time')->nullable();
            $table->timeStamps();
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
        Schema::drop('botanical_irrigations');
    }

}
