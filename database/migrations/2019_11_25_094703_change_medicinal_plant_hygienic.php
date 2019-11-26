<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class ChangeMedicinalPlantHygienic extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('medicinal_plants', function (Blueprint $table) {
            $table->dropForeign(['hygienic_cosmetic_industry_id']);
            $table->dropColumn('hygienic_cosmetic_industry_id');

        });
        Schema::table('medicinal_plants', function (Blueprint $table) {
            $table->boolean('hygienic_cosmetic_industry_id')->nullable();

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
