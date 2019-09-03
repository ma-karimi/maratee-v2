<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaleontologyMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paleontology_maps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('paleontology_id');
            $table->unsignedBigInteger('map_id');
            $table->foreign('paleontology_id')->references('id')->on('paleontologies')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('map_id')->references('id')->on('maps')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paleontology_maps');
    }
}
