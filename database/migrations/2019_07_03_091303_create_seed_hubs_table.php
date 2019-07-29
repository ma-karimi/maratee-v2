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
            $table->unsignedInteger('user_id');


            $table->json('action_role')->nullable();
            $table->json('action_role_description')->nullable();
            $table->unsignedInteger('seed_id');
            $table->unsignedInteger('location_id');
            $table->unsignedInteger('action_id');
            $table->date('date')->nullable();

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
