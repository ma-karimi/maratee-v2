<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistributionHubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distribution_hubs', function (Blueprint $table) {
            $table->bigIncrements('id');
            //Flora, Botanical
            $table->morphs('distributable');
            $table->unsignedBigInteger('geographical_id');
            $table->foreign('geographical_id')->references('id')->on('geographicals')->onUpdate('NO ACTION')->onDelete('cascade');

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
        Schema::table('distribution_hubs', function (Blueprint $table) {
            $table->dropForeign(['geographical_id']);
        });
        Schema::dropIfExists('distribution_hubs');
    }
}
