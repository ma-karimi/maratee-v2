<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationHubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('location_hubs', function (Blueprint $table) {
            $table->increments('id');
            $table->morphs('locationable');
            $table->unsignedInteger('location_id');
            $table->timestampsTz();
            $table->softDeletesTz();
            $table->foreign('location_id')->references('id')->on('locations')->onUpdate('NO ACTION')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('location_hubs', function (Blueprint $table) {
            $table->dropForeign(['location_id']);
        });
        Schema::drop('location_hubs');
    }
}
