<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSeedTechnologiesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seed_technologies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->json('type')->nullable();
            $table->integer('conserved_content')->nullable();
            $table->integer('mean_seed_per_fruit')->nullable();
            $table->integer('thousand_seed_weight')->nullable();
            $table->integer('humidity')->nullable();
            $table->integer('purity')->nullable();
            $table->integer('empty_impurity_seeds')->nullable();
            $table->integer('abnormal_seeding')->nullable();
            $table->integer('rotten_seed')->nullable();
            $table->integer('fresh_none_germinated')->nullable();
            $table->json('other_detail')->nullable();
            $table->string('seed_origin')->nullable();
            $table->date('received_date')->nullable();
            $table->date('banked_date')->nullable();
            $table->integer('thousand_fruit_weight')->nullable();
            $table->integer('viability')->nullable();
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
        Schema::drop('seed_technologies');
    }

}
