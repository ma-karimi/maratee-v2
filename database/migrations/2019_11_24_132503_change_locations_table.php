<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class ChangeLocationsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('locations', function (Blueprint $table) {
            $table->dropForeign(['village_id']);
        });
        Schema::table('locations', function (Blueprint $table) {
            $table->string('village')->nullable();
        });

//        \App\Models\Location::all()
//        ->load('villager')->each(function ($query) {
//            $query->update(['village'=>!empty($query['villager']['name_en']) ? $query['villager']['name_en'] : null ]);
//        });

//        Schema::dropIfExists('villages');
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
