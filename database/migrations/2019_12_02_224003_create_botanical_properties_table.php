<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBotanicalPropertiesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('botanical_properties', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('botanical_id');
            $table->tinyInteger('property_id');
            $table->tinyInteger('type_id');
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
