<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGerminationNumbersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('germination_numbers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('seed_evaluation_id');
            $table->integer('count');
            $table->string('germinated_number');
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
        Schema::drop('germination_numbers');
    }

}
