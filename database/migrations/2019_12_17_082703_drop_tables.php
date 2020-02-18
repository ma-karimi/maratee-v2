<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class DropTables extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        Schema::dropIfExists('entry_hubs');
        Schema::dropIfExists('entries');
        Schema::dropIfExists('divisions');
        Schema::dropIfExists('soils');
        Schema::dropIfExists('lightings');
        Schema::dropIfExists('transaction_evidences');

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
