<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSeedHubTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seed_hub', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('project_id')->nullable()->index('fk_project_has_person_project1_idx');
            $table->unsignedInteger('person_id')->index('fk_project_has_person_person1_idx');
            $table->unsignedInteger('action_role_id')->nullable()->index('fk_project_has_person_action_role1_idx');
            $table->unsignedInteger('seed_id')->index('fk_project_has_person_seed1_idx');
            $table->unsignedInteger('location_id')->index('fk_project_has_person_location1_idx');
            $table->unsignedInteger('action_id')->index('fk_seed_hub_action1_idx');
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
        Schema::drop('seed_hub');
    }

}
