<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeConnectionRelatedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('continents');
    }
}
