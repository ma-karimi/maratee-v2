<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddTaxonomyToSeedCollectionsTable extends Migration
{
    /** * Run the migrations. * * @return void */
    public function up()
    {
        Schema::table('seed_collections', function (Blueprint $table) {
            $table->longtext('taxonomy_data')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('seed_collections', function (Blueprint $table) {
            $table->dropColumn(['taxonomy_data']);
        });
    }
}
