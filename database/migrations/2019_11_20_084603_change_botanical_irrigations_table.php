<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class ChangeBotanicalIrrigationsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('botanical_irrigations', function (Blueprint $table) {
            $table->renameColumn('requirement', 'requirement_id')->comment("[1 => 'sparse', 2 => 'moderate', 3 => 'heavy']")->nullable();
            $table->renameColumn('appropriate_irrigation_time', 'irrigation_time_id')->nullable()->comment("[1 => 'indifferent', 2 => 'morning', 3 => 'day', 4 => 'evening', 5 => 'night']");
            $table->dropForeign(['irrigation_id']);
            $table->dropColumn('irrigation_id');

        });
        Schema::table('botanical_irrigations', function (Blueprint $table) {
            $table->tinyInteger('irrigation_id')->comment("[1 => 'mist', 2 => 'sprinkler', 3 => 'drip', 4 => 'manual', 5 => 'pot watering', 6=>'none']");

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
