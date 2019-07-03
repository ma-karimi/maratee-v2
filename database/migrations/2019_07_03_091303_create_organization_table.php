<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrganizationTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organization', function (Blueprint $table) {
            $table->increments('id');
            $table->string('domestic_code', 45)->nullable();
            $table->string('international_code', 45)->nullable();
            $table->string('is_herbarium', 45)->nullable();
            $table->text('name')->nullable();
            $table->text('description')->nullable();
            $table->integer('phone')->nullable();
            $table->string('email', 45)->nullable();
            $table->string('website', 45)->nullable();
            $table->integer('person_id');
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
        Schema::drop('organization');
    }

}
