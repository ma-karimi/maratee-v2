<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCredentialsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credentials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->json('name');
            $table->string('type')->comment('gift, fair, purchase, correspondence, expense');
            $table->date('date');
            $table->string('archive_no', 45)->nullable();
            $table->string('place')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();


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
        Schema::drop('credentials');
    }

}
