<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCityIdToLocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('locations', function (Blueprint $table) {
            $table->unsignedInteger('city_id');
            $table->foreign('city_id')->references('id')->on('cities')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('village_id')->references('id')->on('villages')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->json('address')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('locations', function (Blueprint $table) {
            $table->dropForeign(['city_id']);
            $table->dropForeign(['village_id']);
            $table->dropColumn('city_id');
            $table->json('address')->nullable()->change();
        });
    }
}
