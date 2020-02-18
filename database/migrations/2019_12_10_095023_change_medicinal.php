<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeMedicinal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medicinal_plants', function (Blueprint $table) {

            $table->dropForeign(['medicine_id']);
            $table->dropForeign(['product_id']);
            $table->dropForeign(['pharmaceutical_form_id']);
            $table->dropForeign(['effective_material_id']);
            $table->dropForeign(['secondary_metabolite_id']);
            $table->dropForeign(['method_analyse_id']);
            $table->dropForeign(['method_extraction_id']);
            $table->dropForeign(['method_distillation_id']);

            $table->dropColumn( ['location_id',  'efficiency', 'treatment_id', 'medicine_id', 'product_id', 'studied_sample', 'presence_in_country', 'phenology_id', 'method_distillation_id', 'method_extraction_id', 'method_analyse_id', 'secondary_metabolite_id', 'effective_material_id', 'industrial_potential_id', 'cultivated_area', 'article_id']);


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medicinal_plants');
    }
}
