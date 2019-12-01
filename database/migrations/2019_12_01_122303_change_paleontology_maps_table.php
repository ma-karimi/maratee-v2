<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class ChangePaleontologyMapsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('paleontology_maps', function (Blueprint $table) {
            $table->dropForeign(['map_id']);
            $table->string('reference');
            $table->string('year')->nullable();
            $table->string('scale')->nullable();

        });

    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }

}
