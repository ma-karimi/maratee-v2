<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeConnectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('locations', function (Blueprint $table) {
            $table->json('region_name')->nullable();
            $table->json('address')->nullable();
            $table->unsignedInteger('village_id')->nullable();
            $table->dropForeign(['region_id']);
            $table->dropForeign(['address_id']);
            $table->dropColumn('region_id', 'address_id');
        });
        try {
            Schema::table('countries', function (Blueprint $table) {
                $table->dropForeign(['continent_id']);
            });
        } catch (Exception $e) {

        }
        Schema::dropIfExists('continents');
        Schema::create('continents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 256);
        });
        Schema::dropIfExists('regions');
        Schema::dropIfExists('addresses');
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
