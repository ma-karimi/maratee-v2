<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSeedTechnologyTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seed_technology', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('seed_id')->index('fk_seed_technology_seed1_idx');
            $table->text('seed_type')->nullable();
            $table->text('type')->nullable();
            $table->integer('husk_average')->nullable();
            $table->integer('husk_weight')->nullable();
            $table->integer('seed_weight')->nullable();
            $table->integer('humidity')->nullable();
            $table->integer('purity')->nullable();
            $table->integer('hard_seed')->nullable();
            $table->integer('abnormality')->nullable();
            $table->integer('sprout')->nullable();
            $table->integer('vigor')->nullable();
            $table->date('examine')->nullable();
            $table->text('descriptions')->nullable();
            $table->integer('person_id');
            $table->tinyInteger('status_id')->default(0);
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
        Schema::drop('seed_technology');
    }

}
