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
            $table->string('description')->nullable();
            $table->string('v_number')->nullable();
            $table->unsignedBigInteger('taxonomy_id');
            $table->unsignedBigInteger('article_id')->nullable();
            $table->unsignedBigInteger('location_id')->nullable();
            $table->unsignedBigInteger('general_class_id');

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
        Schema::drop('chromosomes');
    }

}
