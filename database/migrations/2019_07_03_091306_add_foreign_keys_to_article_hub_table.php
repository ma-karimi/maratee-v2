<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToArticleHubTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('article_hubs', function (Blueprint $table) {
            $table->foreign('cryo_bank_id')->references('id')->on('cryo_bank')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('location_id')->references('id')->on('location')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('action_id')->references('id')->on('actions')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('article_id')->references('id')->on('articles')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('person_id')->references('id')->on('person')->onUpdate('NO ACTION')->onDelete('NO ACTION');
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
            $table->dropForeign(['person_id']);
        });
    }

}
