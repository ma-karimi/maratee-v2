<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTechnologyCollectionTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('technology_collection', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('seed_technology_id')->index('fk_seed_technology_has_collection_seed_technology1_idx');
            $table->integer('collection_id')->index('fk_seed_technology_has_collection_collection1_idx');
            $table->primary(['seed_technology_id', 'collection_id']);
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
        Schema::drop('technology_collection');
    }

}
