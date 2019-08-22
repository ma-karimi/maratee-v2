<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSeedFeaturesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seed_features', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->json('name');
            $table->string('unit');
            $table->string('type');
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
        Schema::drop('seed_features');
    }

}
