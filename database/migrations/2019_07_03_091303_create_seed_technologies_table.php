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
            $table->json('type')->nullable();
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
            $table->json('description')->nullable();
            $table->unsignedInteger('person_id');
			$table->unsignedInteger('creator_id');
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
        Schema::drop('seed_technologies');
    }

}
