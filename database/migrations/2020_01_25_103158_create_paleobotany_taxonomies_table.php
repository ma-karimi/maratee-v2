<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaleobotanyTaxonomiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paleobotany_taxonomies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            //generals
            $table->unsignedBigInteger('family_id')->nullable();
            $table->unsignedBigInteger('genus_id');
            $table->unsignedBigInteger('species_id');
            $table->unsignedBigInteger('infra_specific_id')->nullable();
            $table->unsignedBigInteger('order_id')->nullable();
            $table->unsignedBigInteger('type_status_id')->nullable();

            $table->foreign('genus_id')->references('id')->on('paleobotany_generals')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('species_id')->references('id')->on('paleobotany_generals')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('family_id')->references('id')->on('paleobotany_generals')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('paleobotany_generals')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('type_status_id')->references('id')->on('paleobotany_generals')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('infra_specific_id')->references('id')->on('paleobotany_generals')->onUpdate('NO ACTION')->onDelete('cascade');


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
        Schema::dropIfExists('paleobotany_taxonomies');
    }
}
