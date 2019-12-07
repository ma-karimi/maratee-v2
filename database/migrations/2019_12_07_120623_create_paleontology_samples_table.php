<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaleontologySamplesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paleontology_samples', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('paleontology_id');
            $table->unsignedBigInteger('sample_id')->comment('form Generals');
            $table->timestamps();
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
        Schema::dropIfExists('palebotany_samples');
    }
}
