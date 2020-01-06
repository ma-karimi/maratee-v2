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
            $table->unsignedBigInteger('taxonomy_id');
            $table->unsignedBigInteger('general_habitat_id')->nullable();
            $table->unsignedBigInteger('origin_id')->nullable();
            $table->boolean('monopoly_of_iran_id')->default(0);
            $table->tinyInteger('wooden_id')->nullable()->comment('1:Tree, 2:Shrub');
            $table->tinyInteger('cycle_id')->nullable()->comment('1:evergreen,2:deciduous,3:semi deciduous, 4: annual climber, 5:perennial climber, 6:annual herb, 7:biennial herb, 8:perennial herb, 9:bulb, 10:tuber, 11:rhizome, 12:water plant
');
            $table->unsignedBigInteger('protection_id')->nullable();
            $table->float('height', 4, 2)->nullable();
            $table->tinyInteger('value_id')->nullable()->comment('1:Shape, 2:Bark, 3: leaves, 4: autumn color, flower');
            $table->tinyInteger('usage_id')->nullable()->comment('1:medicinal, 2:ground cover, 3: hedge, 4: ornamental, 5: industrial');


            $table->string('flower_color')->nullable();
            $table->string('fruit_color')->nullable();
            $table->string('foliage_color')->nullable();
            $table->unsignedBigInteger('garden_id')->nullable();
            $table->tinyInteger('entrance_to_garden_id')->nullable()->comment('1 => seedling, 2 => plant, 3 => bulb, 4 => bulbil, 5 => tuber, 6 => rhizome, 7=>softwood cutting, 8=>hardwood cutting, 9=>root cutting, 10=>graft-division, 11=>meristem, 12=>spore');

            $table->tinyInteger('seed_germination_id')->nullable()->comment('[1: good, 2: moderate, 3: low, 4: none]');

            $table->date('planting_date')->nullable();
            $table->float('cutting_rooting', 4, 2)->nullable();

            $table->string('treatment')->nullable();

            $table->tinyInteger('growth_rate_id')->default(0)->comment('[0:unknown, 1: very low, 2: low, 3: moderate, 4: fast, 5: very fast]');
            $table->date('first_flowering')->nullable();
            $table->date('first_seeding')->nullable();
            $table->tinyInteger('seed_rate_id')->nullable()->comment('[1: low, 2: moderate, 3: good, 4: bumper]');
            $table->tinyInteger('seed_formation_id')->nullable()->comment('[1: yes, 2: no]');

            $table->tinyInteger('winter_tolerance_id')->nullable()->comment('[1: good, 2: moderate, 3: sensitive, 4: protection, 5: not surviving, 6: minimum temperature]');
            $table->tinyInteger('summer_tolerance_id')->nullable()->comment('[ 1: good, 2: moderate, 3: sensitive, 4: protection, 5: not surviving]');
//            $table->tinyInteger('planting_condition_id')->nullable()->comment('[ 1: full sun, 2: light shade, 3: moderate shade, 4: deep shade, 5: greenhouse, 6: fancing N, 7: fancing W, 8:  fancing S, 9: fancing E]');
            $table->text('comments')->nullable();
            $table->string('garden_map')->nullable();
            $table->string('sensitivity_conditions')->nullable();


            $table->unsignedBigInteger('soil_id')->nullable()->comment('1 => neutral, 2 => alkaline, 3 => acid, 4 => indifferent');

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
