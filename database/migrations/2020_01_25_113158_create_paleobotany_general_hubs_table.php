<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaleobotanyGeneralHubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paleobtany_general_hubs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('paleobotany_general_id');
            $table->morphs('modelable');
            $table->string('value')->nullable();
            $table->timeStamps();
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
        Schema::dropIfExists('paleobtany_general_hubs');
    }
}
