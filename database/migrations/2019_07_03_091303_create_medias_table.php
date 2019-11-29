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
            $table->bigIncrements('id');
            $table->dateTime('date')->nullable();
            $table->tinyInteger('media_type')->default(2)->comment('1=> sketch , 2=> picture,3=>relevant correspondence, 4=>treatment document, 5=>expense documents');
            $table->string('reference')->nullable();
//          morphs:  'transaction , plant herbarium, paleontology, product, botanical, user, article, action, chromosome, cryo, seed, garden'

            //ADD spatie attributes
            //$table->morphs('mediable');
            $table->morphs('model');
            $table->string('collection_name');

            $table->string('name');
            $table->string('file_name');
            $table->string('mime_type')->nullable();
            $table->string('disk');
            $table->unsignedInteger('size');
            $table->json('manipulations')->nullable();
            $table->json('custom_properties')->nullable();
            $table->json('responsive_images')->nullable();
            $table->unsignedInteger('order_column')->nullable();
            //$table->nullableTimestamps();
            $table->timeStamps();
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
        Schema::drop('medias');
    }

}
