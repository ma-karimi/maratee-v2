<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaleontologyTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paleontology', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('catalog_no')->nullable()->comment('catalog Number
');
            $table->text('specimen_no')->nullable()->comment('Specimen Number
');
            $table->text('field_no')->nullable()->comment('field_no
');
            $table->text('barcode_no')->nullable();
            $table->text('move_status')->nullable();
            $table->text('salon')->nullable();
            $table->integer('closet')->nullable();
            $table->integer('drawer')->nullable();
            $table->text('infraspecific')->nullable();
            $table->text('typestatus')->nullable();
            $table->text('preservation')->nullable();
            $table->integer('pieces')->nullable();
            $table->text('color')->nullable();
            $table->text('element')->nullable();
            $table->integer('geology_age_id')->nullable()->index('fk_paleontology_geology_age1_idx');
            $table->text('treatment')->nullable();
            $table->text('additional_info')->nullable();
            $table->text('access')->nullable();
            $table->date('last_update')->nullable();
            $table->text('excavation')->nullable();
            $table->text('collection_name')->nullable();
            $table->integer('location_no')->nullable();
            $table->text('common_name')->nullable();
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
        Schema::drop('paleontology');
    }

}
