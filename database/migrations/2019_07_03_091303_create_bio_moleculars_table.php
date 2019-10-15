<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBioMolecularsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bio_moleculars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('repeat');
            $table->string('value');
            $table->unsignedBigInteger('technology_id');
            $table->unsignedBigInteger('block_id')->nullable();
            $table->unsignedBigInteger('seed_feature_id');
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
        Schema::drop('bio_moleculars');
    }

}
