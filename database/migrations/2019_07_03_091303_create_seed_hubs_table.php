<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSeedHubsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seed_hubs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('project_id')->nullable();
            $table->unsignedInteger('person_id');
            $table->unsignedInteger('creator_id');

            $table->unsignedInteger('action_role_id')->nullable();
            $table->unsignedInteger('seed_id');
            $table->unsignedInteger('location_id');
            $table->unsignedInteger('action_id');
            $table->date('date')->nullable();
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
        Schema::drop('seed_hubs');
    }

}
