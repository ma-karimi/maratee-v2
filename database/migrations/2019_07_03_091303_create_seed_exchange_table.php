<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSeedExchangeTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seed_exchange', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('seed_id')->index('fk_seed_exchange_seed1_idx');
            $table->integer('collection_id')->index('fk_seed_exchange_collection1_idx');
            $table->string('type', 45)->nullable()->comment('send
receive
');
            $table->integer('weight')->nullable();
            $table->date('date')->nullable();
            $table->integer('person_id')->nullable()->index('fk_seed_exchange_person1_idx');
            $table->text('approval_no')->nullable();
            $table->text('saved_type')->nullable();
            $table->text('description')->nullable();
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
        Schema::drop('seed_exchange');
    }

}
