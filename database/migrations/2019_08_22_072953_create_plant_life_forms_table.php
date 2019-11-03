<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlantLifeFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plant_life_forms', function (Blueprint $table) {
            $table->bigIncrements('id');

            //from life_form table as tree, life_cycle type
            $table->unsignedBigInteger('plant_id');
            $table->unsignedBigInteger('life_form_id');
            $table->timestamps();
            $table->softDeletesTz();

            $table->foreign('plant_id')->references('id')->on('plants')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('life_form_id')->references('id')->on('life_forms')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plant_life_forms', function(Blueprint $table)
        {
            $table->dropForeign(['plant_id']);
            $table->dropForeign(['life_form_id']);
        });
        Schema::dropIfExists('plant_life_forms');
    }
}
