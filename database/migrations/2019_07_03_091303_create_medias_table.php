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
            $table->json('name');
            $table->string('src');
            $table->string('format_type', 45);
            $table->dateTime('date')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('location_id')->nullable();
            $table->json('description')->nullable();
            $table->json('info_type')->nullable();
            $table->json('reference')->nullable();
//            'plant, herbarium, paleontology, product, botanical, user, article, action, chromosome, cryo, seed, garden'
            $table->morphs('mediable');

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
