<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateJournalsTable extends Migration
{


    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('journals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->timeStamps();
            $table->softDeletesTz();

        });

        Schema::table('articles', function (Blueprint $table){
            $table->dropColumn('journal_name');
            $table->unsignedBigInteger('journal_id')->nullable();
        });

    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }

}
