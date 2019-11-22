<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class ChangeHerbariumMedicinalPlantsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('medicinal_plants', function (Blueprint $table) {
            $table->dropColumn('plant_herbarium_id');
            $table->string('herbarium_number')->nullable();
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
