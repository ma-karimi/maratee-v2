<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToChromosomesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('chromosomes', function (Blueprint $table) {
            $table->foreign('article_id')->references('id')->on('articles')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('cryo_bank_id')->references('id')->on('cryo_banks')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('herbarium_id')->references('id')->on('herbariums')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('location_id')->references('id')->on('locations')->onUpdate('NO ACTION')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chromosomes', function (Blueprint $table) {
            $table->dropForeign(['article_id']);
            $table->dropForeign(['cryo_bank_id']);
            $table->dropForeign(['herbarium_id']);
            $table->dropForeign(['location_id']);
        });
    }

}
