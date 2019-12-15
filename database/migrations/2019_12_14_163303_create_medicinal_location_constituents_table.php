<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMedicinalLocationConstituentsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

//        Schema::drop('medicinal_plant_constituents');
        Schema::create('medicinal_location_constituents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('medicinal_location_id');
            $table->unsignedBigInteger('constituent_id');
            $table->unsignedBigInteger('constituent_type_id');
            $table->float('value', 4, 2);
            $table->timestamps();
            $table->softDeletesTz();
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
