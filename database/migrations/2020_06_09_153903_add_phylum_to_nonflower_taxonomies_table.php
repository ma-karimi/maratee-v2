<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddPhylumToNonflowerTaxonomiesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nonflower_taxonomies', function (Blueprint $table) {
            $table->enum('phylum', ['Lichen', 'Moss', 'Diatom', 'Algae'])->default('Lichen');
        });

        Schema::table('nonflowers', function (Blueprint $table) {
            $table->string('herbarium_name')->nullable();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }

}
