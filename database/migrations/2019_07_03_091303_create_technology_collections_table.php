<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTechnologyCollectionsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('technology_collections', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('seed_technology_id');
            $table->unsignedInteger('collection_id');

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
        Schema::drop('technology_collections');
    }

}
