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
            $table->integer('n_no');
            $table->integer('2n_no')->nullable();
            $table->json('notes')->nullable();
            $table->string('url')->nullable();
            $table->unsignedBigInteger('herbarium_id');
            $table->unsignedBigInteger('cryo_bank_id')->nullable();
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
