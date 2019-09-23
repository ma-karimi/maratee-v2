<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeHerbariumRelatedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('herbariums', function (Blueprint $table) {
            $table->unsignedBigInteger('plant_herbarium_id');
            $table->foreign('plant_herbarium_id')->references('id')->on('plant_herbariums')->onUpdate('NO ACTION')->onDelete('CASCADE');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('herbariums', function (Blueprint $table) {
            $table->dropForeign(['plant_herbarium_id']);
            $table->dropColumn('plant_herbarium_id');

        });
    }
}
