<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangePaleontologiesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \App\Utility::truncateTables();


        Schema::table('maps', function (Blueprint $table){
            $table->string('name');
            $table->string('url')->nullable();
        });
        Schema::table('geology_ages', function (Blueprint $table){
            $table->dropColumn('era', 'period', 'epoch', 'stage');
            $table->json('name');
            $table->enum('type', ['era', 'period', 'epoch', 'stage']);
            $table->unsignedBigInteger('parent_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \App\Utility::truncateTables();

        Schema::table('maps', function (Blueprint $table){
            $table->dropColumn('name', 'url');
        });
        Schema::table('geology_ages', function (Blueprint $table){
            $table->dropColumn('name', 'type', 'parent_id');
            $table->json('era');
            $table->json('period');
            $table->json('epoch');
            $table->json('stage');
        });
    }

}
