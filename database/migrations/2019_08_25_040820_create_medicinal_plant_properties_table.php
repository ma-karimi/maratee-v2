<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicinalPlantPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicinal_plant_properties', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('medicinal_plant_id');
            $table->unsignedBigInteger('medicinal_plant_type_id');
            $table->timestamps();
            $table->softDeletesTz();
            $table->foreign('medicinal_plant_id')->references('id')->on('medicinal_plants')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('medicinal_plant_type_id')->references('id')->on('medicinal_plant_types')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::dropIfExists('medicinal_plant_properties');
    }
}
