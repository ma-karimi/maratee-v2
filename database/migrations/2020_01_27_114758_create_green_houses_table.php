<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGreenHousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('green_houses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_en');
            $table->boolean('field_or_greenhouse');
            $table->unsignedBigInteger('location_id');
            $table->timeStamps();
            $table->softDeletesTz();
            $table->foreign('location_id')->references('id')->on('locations')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('green_houses');
    }
}
