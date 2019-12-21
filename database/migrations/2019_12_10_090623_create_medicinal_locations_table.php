<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicinalLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicinal_locations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('code');
            $table->unsignedBigInteger('medicinal_plant_id');
            $table->unsignedBigInteger('location_id');
            $table->unsignedBigInteger('article_id');
            $table->unsignedBigInteger('treatment_id')->nullable();

            $table->float('efficiency', 4, 2)->nullable();
            $table->unsignedBigInteger('general_habitat_id')->nullable();
            $table->tinyInteger('studied_sample')->comment('0:unknown, 1:wild, 2: cultivated')->default(0);
            $table->tinyInteger('presence_in_country')->comment('0:unknown, 1:native, 2: endemic')->default(0);
            $table->unsignedBigInteger('phenology_id')->nullable()->comment('from medicinal_plant_types');
            $table->unsignedBigInteger('method_distillation_id')->nullable();
            $table->unsignedBigInteger('method_extraction_id')->nullable();
            $table->unsignedBigInteger('method_analyse_id')->nullable();
            $table->string('herbarium_number')->nullable();

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
        Schema::dropIfExists('medicinal_locations');
    }
}
