<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMedicalsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicals', function (Blueprint $table) {
            $table->unsignedInteger('herbarium_id');
            $table->unsignedInteger('medicine_side_effect_id')->nullable();
            $table->json('side_effect_description')->nullable();
            $table->unsignedInteger('medicine_effect_id');
            $table->json('medicine_effect_description')->nullable();
            $table->unsignedInteger('medicine_therapy_id')->nullable();
            $table->json('therapy_description')->nullable();
            $table->unsignedInteger('medicine_drug_id')->nullable();
            $table->json('drug_description')->nullable();
            $table->unsignedInteger('product_id')->nullable();
            $table->unsignedInteger('medicine_drug_shape_id')->nullable();
            $table->json('drug_shape_description')->nullable();

            $table->unsignedInteger('medicine_medicinal_part_id');
            $table->json('medicinal_part_description')->nullable();

            $table->unsignedInteger('medicine_drug_usage_id')->nullable();
            $table->json('drug_usage_description')->nullable();



            $table->timeStampsTz();
            $table->dateTimeTz('deleted_at')->nullable();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('medicals');
    }

}
