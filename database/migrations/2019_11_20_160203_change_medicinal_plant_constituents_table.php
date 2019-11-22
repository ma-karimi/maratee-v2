<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class ChangeMedicinalPlantConstituentsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('medicinal_plant_constituents', function (Blueprint $table) {
            $table->dropForeign(['constituent_id']);
            $table->dropColumn('constituent_id');
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
