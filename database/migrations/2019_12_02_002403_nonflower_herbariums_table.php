<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class NonflowerHerbariumsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('herbariums', function (Blueprint $table) {
            $table->dropColumn('plant_id');
            $table->boolean('is_flowering')->default(1);
            $table->unsignedBigInteger('general_habitat_id')->nullable();
            $table->unsignedBigInteger('general_phytogeography_id')->nullable();
            $table->tinyInteger('general_substrate_id')->nullable();


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
