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
            $table->foreign('plant_id')->references('id')->on('plants')->onUpdate('NO ACTION')->onDelete('CASCADE');
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
            $table->dropForeign(['plant_id']);
            $table->dropForeign(['general_class_id']);
        });
    }

}
