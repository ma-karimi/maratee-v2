<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class ChangeSeedsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('seeds', function (Blueprint $table) {
            $table->dropColumn('accession_code');

        });
        Schema::table('seeds', function (Blueprint $table) {
            $table->string('accession_code');

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
