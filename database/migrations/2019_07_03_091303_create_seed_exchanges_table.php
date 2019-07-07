<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSeedExchangesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seed_exchanges', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('seed_id');
            $table->unsignedInteger('collection_id');
            $table->string('type', 45)->nullable()->comment('send
receive
');
            $table->integer('weight')->nullable();
            $table->date('date')->nullable();
            $table->unsignedInteger('person_id')->nullable();
            $table->unsignedInteger('creator_id');

            $table->json('approval_no')->nullable();
            $table->json('saved_type')->nullable();
            $table->json('description')->nullable();
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
        Schema::drop('seed_exchanges');
    }

}
