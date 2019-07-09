<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMediasTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medias', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->string('format_type', 45);
            $table->dateTime('date')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('location_id')->nullable();
            $table->text('description')->nullable();
            $table->unsignedInteger('herbarium_id')->nullable();
            $table->unsignedInteger('seed_id')->nullable();
            $table->unsignedInteger('paleontology_id')->nullable();
            $table->text('info_type')->nullable();
            $table->text('reference')->nullable();
            $table->unsignedInteger('medicinal_plant_id')->nullable();
            $table->unsignedInteger('product_id')->nullable();
            $table->unsignedInteger('botanical_id')->nullable();

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
        Schema::drop('medias');
    }

}
