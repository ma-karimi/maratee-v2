<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCryoBanksTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cryo_banks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('voucher_number');
            $table->string('geotype_code');
            $table->unsignedInteger('protection_id');
            $table->date('entry_date')->nullable();
            $table->string('sample_type', 45)->nullable();
            $table->json('treatment')->nullable();
            $table->integer('repetition')->nullable();
            $table->json('tank_type')->nullable();
            $table->integer('layering_no')->nullable();
            $table->integer('tank_no')->nullable();
            $table->integer('cell_no')->nullable();
            $table->integer('row_no')->nullable();
            $table->string('rack_no')->nullable();
            $table->string('proposal_name')->nullable();
            $table->unsignedInteger('herbarium_id');
            $table->unsignedInteger('user_id');

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
        Schema::drop('cryo_banks');
    }

}
