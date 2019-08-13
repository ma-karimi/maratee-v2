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
            $table->unsignedInteger('taxonomies_id')->nullable();
            $table->unsignedInteger('classification_id')->nullable();
            $table->foreign('taxonomies_id')->references('id')->on('taxonomies')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('classification_id')->references('id')->on('classification')->onUpdate('NO ACTION')->onDelete('cascade');
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
            $table->dropForeign('classification_id');
            $table->dropForeign('taxonomies_id');
            $table->dropColumn('taxonomies_id','classification_id');
        });
    }
}
