<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNonflowersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nonflowers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('herbarium_number')->nullable();
            $table->unsignedBigInteger('location_id')->nullable();
            $table->unsignedBigInteger('taxonomy_id');
            $table->unsignedBigInteger('habitat_id')->nullable();
            $table->unsignedBigInteger('phytogeography_id')->nullable();
            $table->unsignedBigInteger('substrate_id')->nullable();
            $table->text('description')->nullable();

            $table->timeStamps();
            $table->softDeletesTz();
            $table->foreign('location_id')->references('id')->on('locations')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('taxonomy_id')->references('id')->on('taxonomies')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('habitat_id')->references('id')->on('generals')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('phytogeography_id')->references('id')->on('generals')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('substrate_id')->references('id')->on('nonflower_generals')->onUpdate('NO ACTION')->onDelete('CASCADE');

        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('nonflowers');
    }

}
