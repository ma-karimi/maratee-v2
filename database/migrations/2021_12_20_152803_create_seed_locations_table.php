<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeedLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seed_locations', function (Blueprint $table) {
            $table->id();
            $table->string('country_name')->nullable();
            $table->string('province_name')->nullable();
            $table->string('city_name')->nullable();
            $table->string('region_name')->nullable();
            $table->string('village_name')->nullable();
            $table->integer('min_altitude')->nullable();
            $table->integer('max_altitude')->nullable();
            $table->point('point')->nullable();
            $table->text('description')->nullable();
            $table->boolean('gps_used')->default(0);
            $table->string('gps_datum')->nullable();
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
        Schema::dropIfExists('seed_locations');
    }
}
