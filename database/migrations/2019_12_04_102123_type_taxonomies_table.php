<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TypeTaxonomiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('taxonomies', function (Blueprint $table) {
            $table->tinyInteger('type_id')->default(1)->comment('1: flora, 2: nonflower, 3: palebotany');
            $table->boolean('non_native')->default(0)->comment('1: non-native, 0: native');
            $table->string('species_authors')->nullable();
            $table->string('subspecies_authors')->nullable();
            $table->string('variety_authors')->nullable();
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
