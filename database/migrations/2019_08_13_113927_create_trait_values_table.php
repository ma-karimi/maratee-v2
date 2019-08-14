<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTraitValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trait_values', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('seed_feature_id');
            $table->unsignedInteger('character_trait_id');
            $table->double('value')->nullable();
            $table->foreign('seed_feature_id')->references('id')->on('seed_features')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('character_trait_id')->references('id')->on('character_trait')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->softDeletesTz();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trait_values');
    }
}
