<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBotanicalSoilsTable extends Migration
{

    public const TYPE = 'clay soil-loam-fine sand-coarse sand-gravel-shale-salt-gypsum-forest soil-peat-compost-manure-bone powder';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('botanical_soils', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('general_id');
            $table->unsignedBigInteger('botanical_id');
            $table->float('value', 5, 2);
            $table->timeStamps();
            $table->softDeletesTz();

        });


        foreach (explode('-', self::TYPE) as $item) {
            \App\Models\BotanicalGeneral::firstOrCreate([
                'type_id' => 17,
                'name' => $item
            ]);
        }


        Schema::table('botanicals', function(Blueprint $table)
        {
            $table->unsignedBigInteger('collection_id');
            $table->dropColumn(['origin_id', 'general_habitat_id', 'garden_map']);
        });
        Schema::enableForeignKeyConstraints();


    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('botanical_soils');
    }

}
