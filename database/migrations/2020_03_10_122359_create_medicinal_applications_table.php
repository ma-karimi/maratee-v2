<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMedicinalApplicationsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        Schema::create('medicinal_applications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('taxonomy_id');
            $table->tinyInteger('traditional_iranian_medicine')->comment('1:raw, 2: processed')->nullable();

            $table->tinyInteger('natural_drug')->comment('1:Human medicines, 2: Animal drugs')->nullable();
            $table->tinyInteger('inherbal_medicine_store')->comment('1:raw, 2: processed')->nullable();

            $table->tinyInteger('exporting')->comment('1:raw, 2: processed')->nullable();
            $table->tinyInteger('importing')->comment('1:raw, 2: processed')->nullable();
            $table->boolean('hygienic_cosmetic_industry_id')->default(0);
            $table->boolean('cultivated_area_id')->default(0);
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
        //
    }

}
