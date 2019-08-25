<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicinalPlantTypesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicinal_plant_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->json('name');
//            $table->string('name_en')->generatedAs('name->>"$.en"');
            $table->json('description');
            $table->tinyInteger('type_id');
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
        Schema::dropIfExists('medicinal_plant_types');
    }
}
