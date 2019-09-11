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
            $table->bigIncrements('id');
            $table->integer('catalog_no')->nullable()->comment('catalog Number
');
            $table->string('specimen_no')->nullable()->comment('Specimen Number
');
            $table->string('field_no')->nullable()->comment('field_no
');
            $table->string('barcode_no')->nullable();
            $table->text('move_status')->nullable();
            //location in collection
            $table->string('salon')->nullable();
            $table->integer('closet')->nullable();
            $table->integer('drawer')->nullable();

            $table->json('infra_specific')->nullable();
            $table->json('type_status')->nullable();
            $table->json('preservation')->nullable();
            $table->integer('pieces')->nullable();
            $table->json('color')->nullable();
            $table->json('element')->nullable();
            $table->json('treatment_history')->nullable();
            $table->unsignedBigInteger('geology_age_era_id')->nullable();
            $table->unsignedBigInteger('geology_age_period_id')->nullable();
            $table->unsignedBigInteger('geology_age_epoch_id')->nullable();
            $table->unsignedBigInteger('geology_age_stage_id')->nullable();
            $table->unsignedBigInteger('plant_id');
            $table->integer('plates_no')->nullable();
            $table->json('additional_info')->nullable();
            $table->string('access_code')->nullable();
            $table->date('last_update')->nullable();
            $table->json('excavation')->nullable();
            $table->json('collector_name')->nullable();
            $table->unsignedBigInteger('location_id');
            $table->unsignedBigInteger('order_id')->nullable();
            $table->unsignedBigInteger('class_id')->nullable();
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
