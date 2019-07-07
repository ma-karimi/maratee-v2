<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrganizationsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('domestic_code', 45)->nullable();
            $table->string('international_code', 45)->nullable();
            $table->tinyInteger('is_herbarium')->default(1)->comment('0:disable , 1:enable');
            $table->json('name');
            $table->json('description')->nullable();
            $table->string('phone');
            $table->string('email', 45)->nullable();
            $table->string('website', 45)->nullable();
            $table->unsignedInteger('person_id');
			$table->unsignedInteger('creator_id');
            $table->tinyInteger('status_id')->default(0);
            $table->timeStampsTz();
            $table->dateTimeTz('deleted_at')->nullable();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('organizations');
    }

}
