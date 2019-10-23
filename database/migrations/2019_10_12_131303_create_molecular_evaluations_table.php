<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMolecularEvaluationsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('molecular_evaluations', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('seed_id')->nullable();
            $table->text('treat')->nullable();
            $table->integer('repeat')->nullable();
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
        Schema::drop('molecular_evalutions');
    }

}
