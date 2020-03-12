<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class ChangeMedicinalLocationsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('medicinal_plant_constituents');
        Schema::table('medicinal_locations', function (Blueprint $table) {
            $table->dropForeign(['medicinal_plant_id']);
            $table->dropColumn(['medicinal_plant_id', 'presence_in_country']);
            $table->unsignedBigInteger('taxonomy_id');
//
            $table->foreign('taxonomy_id')->references('id')->on('taxonomies')->onUpdate('NO ACTION')->onDelete('CASCADE');

        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('medicinal_locations');
    }

}
