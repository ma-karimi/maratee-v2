<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlacesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::dropIfExists('gardens');
        Schema::create('places', function($table)
        {
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
        //
    }

}
