<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToArticleHubsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('article_hubs', function (Blueprint $table) {
            $table->foreign('cryo_bank_id')->references('id')->on('cryo_banks')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('location_id')->references('id')->on('locations')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('action_id')->references('id')->on('actions')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('article_id')->references('id')->on('articles')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('article_hubs', function (Blueprint $table) {
            $table->dropForeign(['cryo_bank_id']);
            $table->dropForeign(['location_id']);
            $table->dropForeign(['action_id']);
            $table->dropForeign(['article_id']);
            $table->dropForeign(['user_id']);
        });
    }

}
