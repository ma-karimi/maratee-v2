<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBotanicalGeneralsTable extends Migration
{


    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('botanical_generals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->tinyInteger('type_id');
            $table->timeStamps();
            $table->softDeletesTz();

        });



        Schema::create('botanical_colors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('botanical_id');
            $table->unsignedBigInteger('botanical_general_id');
            $table->tinyInteger('type_id')->comment('1:flower, 2:fruit, 3:foliage');
            $table->timeStamps();
            $table->softDeletesTz();

        });

        Schema::create('botanical_general_hubs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('botanical_id');
            $table->unsignedBigInteger('botanical_general_id');
            $table->timeStamps();
            $table->softDeletesTz();

        });

        Schema::dropIfExists('botanical_properties');
        Schema::dropIfExists('botanical_planting_conditions');
        Schema::dropIfExists('botanical_propagations');
        Schema::dropIfExists('irrigations');
        Schema::dropIfExists('propagations');
        Schema::dropIfExists('lightings');
        Schema::enableForeignKeyConstraints();


    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('botanical_generals');
        Schema::dropIfExists('botanical_general_hubs');
        Schema::dropIfExists('botanical_colors');
    }

}
