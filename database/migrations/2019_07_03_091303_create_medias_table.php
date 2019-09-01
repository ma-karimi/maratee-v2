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
            $table->json('name');
            $table->string('src');
            $table->string('format_type', 45);
            $table->dateTime('date')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('location_id')->nullable();
            $table->json('description')->nullable();
            $table->tinyInteger('media_type')->default(0)->comment('0 => unknown , 1=> sketch , 2=> picture');
            $table->json('reference')->nullable();
//            'plant, herbarium, paleontology, product, botanical, user, article, action, chromosome, cryo, seed, garden'
            $table->morphs('mediable');

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
        Schema::drop('medias');
    }

}
