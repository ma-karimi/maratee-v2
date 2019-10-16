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
            $table->foreign('taxonomy_id')->references('id')->on('taxonomies')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('location_id')->references('id')->on('locations')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('article_id')->references('id')->on('articles')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('general_class_id')->references('id')->on('generals')->onUpdate('NO ACTION')->onDelete('CASCADE');
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
            $table->dropForeign(['taxonomy_id']);
            $table->dropForeign(['general_class_id']);
            $table->dropForeign(['location_id']);
            $table->dropForeign(['article_id']);
        });
    }

}
