<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCryoBankTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cryo_bank', function (Blueprint $table) {
            $table->increments('id');
            $table->string('voucher_number', 45)->nullable();
            $table->string('Geotype_code', 45)->nullable();
            $table->integer('protection_id')->nullable()->index('fk_cryo_bank_protection1_idx');
            $table->date('entry_date')->nullable();
            $table->string('sample_type', 45)->nullable();
            $table->text('treatment')->nullable();
            $table->integer('repetition')->nullable();
            $table->text('tank_type')->nullable();
            $table->integer('layering_no')->nullable();
            $table->integer('tank_no')->nullable();
            $table->integer('row_no')->nullable();
            $table->string('rack_no', 45)->nullable();
            $table->integer('cell_no')->nullable();
            $table->integer('herbarium_id')->index('fk_cryo_bank_herbarium1_idx');
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
        Schema::drop('cryo_bank');
    }

}
