<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthorHubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actor_hubs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->morphs('actorable');
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
        Schema::table('actor_hubs', function (Blueprint $table) {
            $table->dropForeign(['actor_id']);
        });
        Schema::dropIfExists('actor_hubs');
    }
}
