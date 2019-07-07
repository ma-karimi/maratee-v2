<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaleontologyActionsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paleontology_actions', function (Blueprint $table) {
            $table->unsignedInteger('paleontology_id');
            $table->unsignedInteger('person_id');
            $table->unsignedInteger('creator_id');

            $table->unsignedInteger('action_id');
            $table->date('date');
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
        Schema::drop('paleontology_actions');
    }

}
