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
            $table->increments('id');
            $table->unsignedInteger('seed_id');
            $table->json('seed_type')->nullable();
            $table->integer('conserved_content')->nullable();
            $table->integer('mean_seed_per_fruit')->nullable();
            $table->integer('thousand_seed_weight')->nullable();
            $table->integer('humidity')->nullable();
            $table->integer('purity')->nullable();
            $table->integer('empty_impurity_seeds')->nullable();
            $table->integer('abnormal_seeding')->nullable();
            $table->integer('rotten_seed')->nullable();
            $table->integer('fresh_none_germinated')->nullable();
            $table->string('accession')->nullable();
            $table->string('seed_origin')->nullable();
            $table->string('regeneration_evaluation')->nullable();
            $table->date('received_date')->nullable();
            $table->date('banked_date')->nullable();
            $table->integer('thousand_fruit_weight')->nullable();
            $table->integer('viability')->nullable();


            $table->json('other_detail')->nullable();

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
        Schema::drop('seed_technologies');
    }

}
