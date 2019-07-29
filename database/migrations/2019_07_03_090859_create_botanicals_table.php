<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBotanicalsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('botanicals', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('herbarium_id');
            $table->float('height', 4)->nullable();
            $table->json('flower_color')->nullable();
            $table->json('fruit_color')->nullable();
            $table->json('leaf_color')->nullable();
            $table->json('sprout')->nullable();
            $table->json('treatment')->nullable();
            $table->json('growth_rate')->nullable();
            $table->json('first_flowering')->nullable();
            $table->json('flowering_interval')->nullable()->comment('based on the number of days
');
            $table->json('first_seeding')->nullable();
            $table->json('seed_value')->nullable();
            $table->json('seed_production')->nullable();
            $table->json('season_resistance')->nullable();
            $table->date('year')->nullable();
            $table->json('sensitivity')->nullable();
            $table->json('sensitivity_description')->nullable();
            $table->json('notes')->nullable();
            $table->date('planting')->nullable();
            $table->integer('scion_rooting_per')->nullable();
            $table->json('entry_type')->nullable();


            $table->timeStampsTz();
            $table->dateTimeTz('deleted_at')->nullable();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('botanicals');
    }

}
