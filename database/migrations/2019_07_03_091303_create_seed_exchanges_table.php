<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSeedExchangesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seed_exchanges', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('seed_id');
            $table->float('seed_weight',4)->nullable();
            $table->date('delivery_date')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('project_id');
            $table->unsignedInteger('department_id');
            $table->string('regeneration_evaluation')->nullable();
            $table->string('request_no')->nullable();
            $table->string('exchange_type')->nullable();
            $table->json('description')->nullable();
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
        Schema::drop('seed_exchanges');
    }

}
