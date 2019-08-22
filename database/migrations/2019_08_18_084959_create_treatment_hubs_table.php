<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTreatmentHubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treatment_hubs', function (Blueprint $table) {
            $table->bigIncrements('id');
//            medicinal_plant, paleontology, botanical, cryo_bank, bio_molecular
            $table->morphs('treatmentable');
            $table->unsignedBigInteger('treatment_id');
            $table->timestampsTz();
            $table->softDeletesTz();
            $table->foreign('treatment_id')->references('id')->on('treatments')->onUpdate('NO ACTION')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('treatment_hubs', function (Blueprint $table) {
            $table->dropForeign(['treatment_id']);
        });
        Schema::drop('treatment_hubs');
    }
}
