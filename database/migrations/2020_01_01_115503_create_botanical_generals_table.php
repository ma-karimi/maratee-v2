<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBotanicalGeneralsTable extends Migration
{

    public const USAGE = [1 => 'medicinal', 2 => 'ground cover', 3 => 'hedge', 4 => 'ornamental', 5 => 'industrial'];
    public const VALUE = [1 => 'Shape', 2 => 'Bark', 3 => 'leaves', 4 => 'autumn color', 5 => 'flower'];
    public const PROPAGATION = [1 => 'seed', 2 => 'cutting', 3 => 'graft', 4 => 'natural regeneration', 5 => 'root sucker', 6 => 'collar sprout'];

    public const PLANT_CONDITION = [1 => 'full sun', 2 => 'light shade', 3 => 'moderate shade', 4 => 'deep shade', 5 => 'greenhouse', 6 => 'fancing N', 7 => 'fancing W', 8 => 'fancing S', 9 => 'fancing E'];

    public const CYCLE = [1 => 'evergreen', 2 => 'deciduous', 3 => 'semi deciduous', 4 => 'annual climber', 5 => 'perennial climber', 6 => 'annual herb', 7 => 'biennial herb', 8 => 'perennial herb', 9 => 'bulb', 10 => 'tuber', 11 => 'rhizome', 12 => 'water plant'];
    public const COLOR = 'white-cream-yellow-orange-pink-red-purple-lilac-blue-green-brown-black-blue green-yellowish-silvery-grey-variegated-glossy';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('botanical_generals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->tinyInteger('type_id');
            $table->timeStamps();
            $table->softDeletesTz();

        });

        foreach (self::CYCLE as $index => $item) {
            \App\Models\BotanicalGeneral::create([
                'type_id' => 5,
                'name' => $item
            ]);
        }

        foreach (self::USAGE as $index => $item) {
            \App\Models\BotanicalGeneral::create([
                'type_id' => 2,
                'name' => $item
            ]);
        }

        foreach (self::PLANT_CONDITION as $index => $item) {
            \App\Models\BotanicalGeneral::create([
                'type_id' => 4,
                'name' => $item
            ]);
        }

        foreach (self::PROPAGATION as $index => $item) {
            \App\Models\BotanicalGeneral::create([
                'type_id' => 3,
                'name' => $item
            ]);
        }

        foreach (self::VALUE as $index => $item) {
            \App\Models\BotanicalGeneral::create([
                'type_id' => 1,
                'name' => $item
            ]);
        }

        foreach (explode('-', self::COLOR) as $index => $item) {
            \App\Models\BotanicalGeneral::create([
                'type_id' => 6,
                'name' => $item
            ]);
        }


        Schema::create('botanical_colors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('botanical_id');
            $table->unsignedBigInteger('botanical_general_id');
            $table->tinyInteger('type_id')->comment('1:flower, 2:fruit, 3:foliage');
            $table->timeStamps();
            $table->softDeletesTz();

        });

        Schema::create('botanical_general_hubs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('botanical_id');
            $table->unsignedBigInteger('botanical_general_id');
            $table->timeStamps();
            $table->softDeletesTz();

        });

//        Schema::dropIfExists('botanical_property');
        Schema::enableForeignKeyConstraints();


    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('botanical_generals');
        Schema::dropIfExists('botanical_general_hubs');
        Schema::dropIfExists('botanical_colors');
    }

}
