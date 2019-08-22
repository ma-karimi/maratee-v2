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
        Schema::create('author_hubs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->morphs('authorable');
            $table->unsignedBigInteger('author_id');
            $table->foreign('author_id')->references('id')->on('authors')->onUpdate('NO ACTION')->onDelete('cascade');

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
        Schema::table('author_hubs', function (Blueprint $table) {
            $table->dropForeign(['author_id']);
        });
        Schema::dropIfExists('author_hubs');
    }
}
