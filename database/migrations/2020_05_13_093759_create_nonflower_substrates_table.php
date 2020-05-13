<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNonflowerSubstratesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nonflower_substrates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('nonflower_id');
            $table->unsignedBigInteger('nonflower_general_id');
            $table->timeStamps();
            $table->softDeletesTz();
            $table->foreign('nonflower_id')->references('id')->on('nonflowers')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('nonflower_general_id')->references('id')->on('nonflower_generals')->onUpdate('NO ACTION')->onDelete('CASCADE');

        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('nonflower_substrates');
    }

}
