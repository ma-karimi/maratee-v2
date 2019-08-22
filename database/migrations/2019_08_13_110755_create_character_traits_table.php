<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharacterTraitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('character_traits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('character_id');
            $table->unsignedBigInteger('block_id');
            $table->string('observation_no')->nullable();
            $table->date('planting_date')->nullable();
            $table->date('observation_date')->nullable();
            $table->integer('days_start_flowering')->nullable();
            $table->integer('days_flowering')->nullable();
            $table->integer('days_seed_ripening')->nullable();
            $table->foreign('character_id')->references('id')->on('characters')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('block_id')->references('id')->on('blocks')->onUpdate('NO ACTION')->onDelete('cascade');
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
        Schema::dropIfExists('character_traits');
    }
}
