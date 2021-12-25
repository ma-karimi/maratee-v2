<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQuantitativesToSeedMorphologiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('seed_morphologies', function (Blueprint $table) {
            $table->longText('quantitatives')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('seed_morphologies', function (Blueprint $table) {
            $table->dropColumn('quantitatives');
        });
    }
}
