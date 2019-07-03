<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaleontologyActionTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paleontology_action', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('paleontology_id')->index('fk_paleontology_action_paleontology1_idx');
            $table->unsignedInteger('person_id')->nullable()->index('fk_paleontology_action_person1_idx');
            $table->unsignedInteger('action_id')->index('fk_paleontology_action_action1_idx');
            $table->date('date')->nullable();
            $table->text('description')->nullable();
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
        Schema::drop('paleontology_action');
    }

}
