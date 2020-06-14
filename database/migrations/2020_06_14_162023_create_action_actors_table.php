<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActionActorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('action_actors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->morphs('actorable');
            $table->tinyInteger('type_id');
            $table->unsignedBigInteger('actor_id');
            $table->foreign('actor_id')->references('id')->on('actors')->onUpdate('NO ACTION')->onDelete('cascade');

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
        Schema::dropIfExists('action_actors');
    }
}
