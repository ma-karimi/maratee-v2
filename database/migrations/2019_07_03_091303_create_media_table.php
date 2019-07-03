<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMediaTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name')->nullable();
            $table->string('format_type', 45)->nullable();
            $table->dateTime('date')->nullable();
            $table->unsignedInteger('person_id')->nullable()->index('fk_photo_person1_idx');
            $table->unsignedInteger('location_id')->nullable()->index('fk_photo_location1_idx');
            $table->text('description')->nullable();
            $table->unsignedInteger('herbarium_id')->nullable()->index('fk_photo_herbarium1_idx');
            $table->unsignedInteger('seed_id')->nullable()->index('fk_photo_seed1_idx');
            $table->unsignedInteger('paleontology_id')->nullable()->index('fk_photo_paleontology1_idx');
            $table->text('info_type')->nullable();
            $table->text('reference')->nullable();
            $table->unsignedInteger('medicinal_plant_id')->nullable()->index('fk_media_medicinal_plant1_idx');
            $table->unsignedInteger('product_id')->nullable()->index('fk_media_product1_idx');
            $table->unsignedInteger('botanical_id')->nullable()->index('fk_media_botanical1_idx');
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
        Schema::drop('media');
    }

}
