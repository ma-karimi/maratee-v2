<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPrimaryKeysTables extends Migration
{

    protected $tables = [
        'botanical_garden_actions',
        'botanical_irrigations',
        'botanical_propagations',
        'medicals',
        'medicinal_plant_constituents',
        'medicinal_plant_morphologies',
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach ($this->tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->bigIncrements('id')->first();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach ($this->tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->dropColumn('id');
            });
        }
    }
}
