<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBotanicalGardensTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('botanical_gardens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('botanical_id');
            $table->unsignedBigInteger('internal_habitat_id')->comment('botanical_generals')->nullable();
            $table->unsignedBigInteger('garden_id')->comment('botanical_generals')->nullable();
            $table->timeStamps();
            $table->softDeletesTz();
            $table->foreign('botanical_id')->references('id')->on('botanicals')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('internal_habitat_id')->references('id')->on('botanical_generals')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('garden_id')->references('id')->on('botanical_generals')->onUpdate('NO ACTION')->onDelete('CASCADE');

        });
        Schema::create('botanical_garden_entrances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('botanical_garden_id');
            $table->unsignedBigInteger('general_id')->comment('botanical_generals');
            $table->timeStamps();
            $table->softDeletesTz();
            $table->foreign('botanical_garden_id')->references('id')->on('botanical_gardens')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('general_id')->references('id')->on('botanical_generals')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });

        Schema::dropIfExists('internal_habitats');
        Schema::table('botanicals', function (Blueprint $table) {
            $table->dropColumn(['internal_habitat_id', 'organization_id', 'entrance_to_garden_id']);
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
        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists('botanical_gardens');
        Schema::dropIfExists('botanical_garden_entrances');
        Schema::enableForeignKeyConstraints();

    }

}
