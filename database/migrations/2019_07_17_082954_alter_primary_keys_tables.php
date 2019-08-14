<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPrimaryKeysTables extends Migration
{

    protected $tables = [
        'evaluation_collections',
        'botanical_garden_actions',
        'botanical_irrigations',
        'botanical_reproductions',
        'cryo_bank_actions',
        'herbarium_appendixes',
        'medicals',
        'medicinal_plant_constituents',
        'medicinal_plant_morphologies',
        'paleontology_actions',
        'paleontology_medias',
        'bio_moleculars',
        'seed_seedFeatures',
        'seed_plants'
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
                $table->increments('id')->first();
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
