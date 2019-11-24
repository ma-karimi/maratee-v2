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
            $table->string('village');
        });

        \App\Models\Location::whereNotNull('village_id')->get()
            ->load('villager')->each(function ($query) {
                $query->update(['village'=>$query['villager']['name_en']]);
            });

        Schema::dropIfExists('villages');
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
