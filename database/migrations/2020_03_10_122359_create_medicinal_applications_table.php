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
            $table->tinyInteger('traditional_iranian_medicine')->comment('0:unknown, 1:raw, 2: processed')->default(0);

            $table->tinyInteger('natural_drug')->comment('0:unknown, 1:Human medicines, 2: Animal drugs')->default(0);
            $table->tinyInteger('inherbal_medicine_store')->comment('0:unknown, 1:raw, 2: processed')->default(0);

            $table->tinyInteger('exporting')->comment('0:unknown, 1:raw, 2: processed')->default(0);
            $table->tinyInteger('importing')->comment('0:unknown, 1:raw, 2: processed')->default(0);
            $table->boolean('hygienic_cosmetic_industry_id')->default(0)->change();
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
