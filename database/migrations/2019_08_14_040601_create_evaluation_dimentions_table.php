<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluationDimentionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluation_dimensions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('evaluation_id');
            $table->unsignedBigInteger('dimension_id');
            $table->integer('value')->nullable();
            $table->foreign('evaluation_id')->references('id')->on('evaluations')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('dimension_id')->references('id')->on('dimensions')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->softDeletesTz();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evaluation_dimentions');
    }
}
