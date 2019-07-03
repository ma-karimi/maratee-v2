<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSeedChemicalTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seed_chemical', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('chemical_id')->index('fk_seed_chemical_chemica
l1');
            $table->unsignedInteger('seed_id')->index('fk_seed_chemical_seed1_idx');
            $table->text('treatment')->nullable();
            $table->integer('repeat')->nullable();
            $table->unsignedInteger('location_id')->nullable()->index('fk_seed_chemical_location1_idx');
//            $table->primary(['chemical_id', 'seed_id']);
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
        Schema::drop('seed_chemical');
    }

}
