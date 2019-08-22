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
            $table->unsignedBigInteger('medicine_side_effect_id');
            $table->json('side_effect_description')->nullable();
            $table->unsignedBigInteger('medicine_effect_id');
            $table->json('effect_description')->nullable();
            $table->unsignedBigInteger('medicine_therapy_id');
            $table->json('therapy_description')->nullable();
            $table->unsignedBigInteger('medicine_drug_id');
            $table->json('drug_description')->nullable();
            $table->unsignedBigInteger('medicine_shape_id');
            $table->json('shape_description')->nullable();

            $table->unsignedBigInteger('medicine_usage_id');
            $table->json('usage_description')->nullable();

            $table->unsignedBigInteger('plant_application_id');
            $table->unsignedBigInteger('product_id')->nullable();


            $table->timeStampsTz();
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
        Schema::drop('medicals');
    }

}
