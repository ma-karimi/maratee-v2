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
            $table->bigIncrements('id');
            $table->string('genotype_code');
            $table->tinyInteger('sample_type_id')->default(0)->comment('0:unknown, 1:seed, 2: shoot, 3: cell');
            $table->integer('repeat')->nullable();
            $table->integer('tank');
            $table->integer('cell');
            $table->integer('row');
            $table->string('rack');
            $table->string('proposal_name')->nullable();
            $table->unsignedBigInteger('taxonomy_id');
            $table->unsignedBigInteger('protection_id');
            $table->unsignedBigInteger('location_id');
            $table->unsignedBigInteger('treatment_id');
            $table->float('treatment_values', 4, 2)->nullable();

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
        Schema::drop('cryo_banks');
    }

}
