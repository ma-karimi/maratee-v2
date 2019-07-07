<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSeedChemicalsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seed_chemicals', function (Blueprint $table) {
            $table->unsignedInteger('chemical_id');
            $table->unsignedInteger('seed_id');
            $table->json('treatment');
            $table->integer('repeat');
            $table->unsignedInteger('location_id')->nullable();
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
        Schema::drop('seed_chemicals');
    }

}
