<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAttendancesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->foreign('herbarium_id')->references('id')->on('herbariums')->onUpdate('NO ACTION')->onDelete('cascade');
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
        Schema::table('attendances', function (Blueprint $table) {
            $table->dropForeign(['herbarium_id']);
            $table->dropForeign(['user_id']);
        });
    }

}
