<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserHubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_hubs', function (Blueprint $table) {
            $table->increments('id');
//            plants, cryo-bank, media, seed_hub, technology, article
            $table->morphs('userable');
            $table->unsignedInteger('user_id');
            $table->timestampsTz();
            $table->softDeletesTz();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_hubs', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        Schema::drop('user_hubs');
    }
}
