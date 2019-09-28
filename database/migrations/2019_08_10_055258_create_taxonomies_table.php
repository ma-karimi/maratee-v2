<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxonomiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxonomies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->json('name')->nullable();
            //generals
            $table->unsignedBigInteger('family_id');
            $table->unsignedBigInteger('genus_id')->nullable();
            $table->unsignedBigInteger('species_id')->nullable();
            $table->unsignedBigInteger('subspecies_id')->nullable();
            $table->unsignedBigInteger('variety_id')->nullable();

            $table->foreign('genus_id')->references('id')->on('generals')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('species_id')->references('id')->on('generals')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('variety_id')->references('id')->on('generals')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('family_id')->references('id')->on('generals')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('subspecies_id')->references('id')->on('generals')->onUpdate('NO ACTION')->onDelete('cascade');


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
        Schema::dropIfExists('taxonomies');
    }
}
