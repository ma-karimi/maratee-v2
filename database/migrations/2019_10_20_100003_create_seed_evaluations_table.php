<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSeedEvaluationsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seed_evaluations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('seed_id');
            $table->date('date_ended')->nullable();
            $table->integer('repeat')->nullable();
            $table->integer('number_of_planted_seeds')->nullable();
            $table->integer('fresh_non_germinated')->nullable();
            $table->integer('rotten_seed')->nullable();
            $table->integer('abnormal')->nullable();
            $table->integer('seedling_mortality')->nullable();
            $table->float('mean_fresh_seedling_weight', 5,2)->nullable();
            $table->float('mean_dry_seedling_weight', 5,2)->nullable()->comment('g, in 10 seedlings');
            $table->float('dry_matter', 4, 2)->nullable()->comment('%');
            $table->text('describe_dormancy_breaking_treatment')->nullable();

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
        Schema::drop('seed_evaluations');
    }

}
