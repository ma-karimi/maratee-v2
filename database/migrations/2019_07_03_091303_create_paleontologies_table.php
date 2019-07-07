<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaleontologiesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paleontologies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('catalog_no')->nullable()->comment('catalog Number
');
            $table->string('specimen_no')->nullable()->comment('Specimen Number
');
            $table->string('field_no')->nullable()->comment('field_no
');
            $table->string('barcode_no')->nullable();
            $table->text('move_status')->nullable();
            $table->string('salon')->nullable();
            $table->integer('closet')->nullable();
            $table->integer('drawer')->nullable();
            $table->json('infraspecific')->nullable();
            $table->json('typestatus')->nullable();
            $table->json('preservation')->nullable();
            $table->integer('pieces')->nullable();
            $table->json('color')->nullable();
            $table->json('element')->nullable();
            $table->unsignedInteger('geology_age_id');
            $table->json('treatment')->nullable();
            $table->json('additional_info')->nullable();
            $table->json('access')->nullable();
            $table->date('last_update')->nullable();
            $table->json('excavation')->nullable();
            $table->json('collection_name')->nullable();
            $table->integer('location_no')->nullable();
            $table->json('common_name')->nullable();
            $table->unsignedInteger('person_id');
			$table->unsignedInteger('creator_id');
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
        Schema::drop('paleontologies');
    }

}
