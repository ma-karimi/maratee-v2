<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('flowering_id');
            $table->unsignedBigInteger('cotyledon_id')->nullable();
            $table->unsignedBigInteger('sperm_id')->nullable();
            $table->foreign('flowering_id')->references('id')->on('generals')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('cotyledon_id')->references('id')->on('generals')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('sperm_id')->references('id')->on('generals')->onUpdate('NO ACTION')->onDelete('cascade');
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
        Schema::dropIfExists('classifications');
    }
}
