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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('project_id')->nullable();


            $table->json('action_role')->nullable();
            $table->json('action_role_description')->nullable();
            $table->unsignedBigInteger('seed_id');
            $table->unsignedBigInteger('location_id');
            $table->unsignedBigInteger('action_id');
            $table->date('date')->nullable();

            $table->timeStamps();
            $table->softDeletesTz();
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
