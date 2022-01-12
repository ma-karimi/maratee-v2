<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaleobotanySamplesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paleobotany_samples', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('paleobotany_taxonomy_id');
            $table->unsignedBigInteger('sample_id');
            $table->timeStamps();
            $table->softDeletesTz();
            $table->foreign('paleobotany_taxonomy_id')->references('id')->on('paleobotany_taxonomies')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('sample_id')->references('id')->on('paleobotany_taxonomies')->onUpdate('NO ACTION')->onDelete('CASCADE');

        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('paleobotany_samples');
    }

}
