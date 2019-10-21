<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSeedLengthsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seed_evaluation_features', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('seed_evaluation_id');
            $table->float('value', 3, 2);
            $table->tinyInteger('length_type')->comment('1:radical_length, 2:shoot_length, 3: seed_length, 4:seed_width');
            $table->timeStamps();
            $table->softDeletesTz();
            $table->foreign('seed_evaluation_id')->references('id')->on('seed_evaluations')->onUpdate('NO ACTION')->onDelete('CASCADE');

        });


    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('seed_length');
    }

}
