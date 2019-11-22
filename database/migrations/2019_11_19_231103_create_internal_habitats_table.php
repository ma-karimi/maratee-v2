<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInternalHabitatsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internal_habitats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_en');
            $table->string('name_fa')->nullable();
            $table->timeStamps();
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
        Schema::drop('internal_habitats');
    }

}
