<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBotanicalSoilsTable extends Migration
{



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



        Schema::table('botanicals', function (Blueprint $table) {
            $table->unsignedBigInteger('collection_id');
            $table->dropColumn(['origin_id', 'general_habitat_id', 'garden_map']);
        });
        Schema::table('action_hubs', function (Blueprint $table) {
            $table->dropForeign(['department_id']);
            $table->dropForeign(['project_id']);
            $table->dropColumn(['project_id', 'department_id']);
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
