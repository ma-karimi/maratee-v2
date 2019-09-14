<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class   CreateChromosomesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chromosomes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('n_no')->nullable();
            $table->string('2n_no')->nullable();
            $table->json('description')->nullable();
            $table->string('v_number')->nullable();
            $table->unsignedBigInteger('plant_id');
            $table->unsignedBigInteger('general_class_id');

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
        Schema::drop('chromosomes');
    }

}
