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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('plant_herbarium_id');
            $table->float('height', 4, 2)->nullable();
            $table->json('flower_color')->nullable();
            $table->json('fruit_color')->nullable();
            $table->json('foliage_color')->nullable();
            $table->json('seed_germination')->nullable();
            $table->date('planting')->nullable();
            $table->integer('cutting_rooting')->nullable();
            $table->json('treatment')->nullable();

            $table->tinyInteger('growth_rate')->default(0)->comment('[0:unknown, 1: very low, 2: low, 3: moderate, 4: fast, 5: very fast]');
            $table->date('first_flowering')->nullable();
            $table->date('first_seeding')->nullable();
            $table->tinyInteger('seed_rate')->default(0)->comment('[0:unknown, 1: low, 2: moderate, 3: good, 4: bumper]');
            $table->tinyInteger('seed_formation')->default(0)->comment('[0:unknown, 1: yes, 2: no]');

            $table->tinyInteger('winter_tolerance')->default(0)->comment('[0:unknown, 1: good, 2: moderate, 3: sensitive, 4: protection, 5: not surviving, 6: minimum temperature]');
            $table->tinyInteger('summer_tolerance')->default(0)->comment('[0:unknown, 1: good, 2: moderate, 3: sensitive, 4: protection, 5: not surviving]');
            $table->json('comments')->nullable();
            $table->json('garden_map')->nullable();

            $table->json('garden_name')->nullable();
            $table->unsignedBigInteger('general_habitat_id')->nullable();
            $table->tinyInteger('entrance_to_garden')->default(0)->comment('[0:unknown, 1: seedling, 2: plant, 3: bulb, 4: bulbil, 5: tuber, 6: rhizome]');
            $table->unsignedBigInteger('soil_id')->nullable();

            $table->timeStamps();
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
        Schema::drop('botanicals');
    }

}
