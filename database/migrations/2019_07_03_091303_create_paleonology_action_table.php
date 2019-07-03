<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaleonologyActionTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paleonology_action', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('paleontology_id')->index('fk_paleonology_action_paleontology1_idx');
            $table->integer('person_id')->nullable()->index('fk_paleonology_action_person1_idx');
            $table->integer('action_id')->index('fk_paleonology_action_action1_idx');
            $table->date('date')->nullable();
            $table->text('description')->nullable();
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
        Schema::drop('paleonology_action');
    }

}
