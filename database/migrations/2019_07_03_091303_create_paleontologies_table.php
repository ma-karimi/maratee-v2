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
            $table->json('infra_specific')->nullable();
            $table->json('type_status')->nullable();
            $table->json('preservation')->nullable();
            $table->integer('pieces')->nullable();
            $table->json('color')->nullable();
            $table->json('element')->nullable();
            $table->unsignedInteger('geology_age_id');
            $table->unsignedInteger('plant_id');
            $table->integer('plates_no')->nullable();
            $table->json('additional_info')->nullable();
            $table->json('access')->nullable();
            $table->date('last_update')->nullable();
            $table->json('excavation')->nullable();
            $table->json('collection_name')->nullable();
            $table->integer('location_no')->nullable();
            $table->json('common_name')->nullable();
            $table->string('update_frequency');
            $table->json('description')->nullable();

            $table->timeStampsTz();
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
        Schema::drop('paleontologies');
    }

}
