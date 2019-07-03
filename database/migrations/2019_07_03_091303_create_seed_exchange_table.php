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
            $table->unsignedInteger('seed_id')->index('fk_seed_exchange_seed1_idx');
            $table->unsignedInteger('collection_id')->index('fk_seed_exchange_collection1_idx');
            $table->string('type', 45)->nullable()->comment('send
receive
');
            $table->integer('weight')->nullable();
            $table->date('date')->nullable();
            $table->unsignedInteger('person_id')->nullable()->index('fk_seed_exchange_person1_idx');
            $table->text('approval_no')->nullable();
            $table->text('saved_type')->nullable();
            $table->text('description')->nullable();
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
