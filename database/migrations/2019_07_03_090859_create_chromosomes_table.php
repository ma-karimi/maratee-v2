<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateChromosomesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chromosomes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('n_no');
            $table->integer('2n_no')->nullable();
            $table->json('notes')->nullable();
            $table->unsignedInteger('herbarium_id');
            $table->unsignedInteger('cryo_bank_id')->nullable();
            $table->unsignedInteger('article_id')->nullable();
            $table->unsignedInteger('location_id')->nullable();

            $table->timeStampsTz();
            $table->dateTimeTz('deleted_at')->nullable();
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
