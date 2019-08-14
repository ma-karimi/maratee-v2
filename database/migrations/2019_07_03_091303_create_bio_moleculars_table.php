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
            $table->string('treatment');
            $table->integer('repeat');
            $table->string('value');
            $table->unsignedInteger('technology_id');
            $table->unsignedInteger('block_id')->nullable();
            $table->unsignedInteger('seed_feature_id');
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
        Schema::drop('bio_moleculars');
    }

}
