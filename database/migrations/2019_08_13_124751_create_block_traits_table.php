<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlockTraitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('block_traits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('block_id');
            $table->unsignedBigInteger('soil_id');
            $table->string('water_source')->nullable();
            $table->string('irrigation_system')->nullable();
            $table->string('irrigation_circuit')->nullable();
            $table->string('irrigation_time')->nullable();
            $table->double('flow_rate')->nullable();
            $table->double('water_ph')->nullable();
            $table->double('water_ec')->nullable();
            $table->string('excel_url')->nullable();
            $table->foreign('block_id')->references('id')->on('blocks')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('soil_id')->references('id')->on('soils')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->softDeletesTz();
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
        Schema::dropIfExists('block_traits');
    }
}
