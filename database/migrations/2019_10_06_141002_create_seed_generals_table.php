<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeedGeneralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seed_generals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->tinyInteger('type')->comment('1:specimen_type, 2:landform, 3:slope_aspect, 4:soil_depth, 5:soil_texture, 6:drainage, 7:salinity, 8:soil_lime, 9:soil_erosion, 10:pollination_type, 11:pollination_agent, 12:fruit_type, 13:seeds_collected_from, 14:life_form, 15:growth_form, 16:plant_mother_health, 17:plant_consumption, 18:used_part, 19:collection_name');
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
        Schema::dropIfExists('seed_generals');
    }
}
