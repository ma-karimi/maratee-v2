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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('seed_id');
            $table->float('seed_weight', 4, 2)->nullable();
            $table->date('delivery_date')->nullable();

            $table->string('recipient_name');
            $table->string('recipient_phone');
            $table->string('request_no');
            $table->text('description')->nullable();
            $table->timeStamps();
            $table->softDeletesTz();
            $table->foreign('seed_id')->references('id')->on('seeds')->onUpdate('NO ACTION')->onDelete('CASCADE');
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
