<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFoerignKeyToPlantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plants', function (Blueprint $table) {
           // $table->foreign('taxonomy_id')->references('id')->on('taxonomies')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('classification_id')->references('id')->on('classifications')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('life_form_cycle_id')->references('id')->on('life_forms')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('life_form_leaf_id')->references('id')->on('life_forms')->onUpdate('NO ACTION')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plants', function (Blueprint $table) {
            $table->dropForeign('life_form_cycle_id');
            $table->dropForeign('life_form_leaf_id');
            $table->dropForeign('classification_id');
            $table->dropForeign('taxonomy_id');
        });
    }
}
