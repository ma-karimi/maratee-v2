<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditSeedWeightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('seed_weights', function (Blueprint $table) {
            $table->unsignedInteger('seed_id')->nullable();
            $table->string('')->nullable();
            $table->string('regeneration_evaluation')->nullable();
            $table->integer('fruit_mean_seeds_no')->nullable();
            $table->double('thousand_fruit_weight')->nullable();
            $table->double('thousand_seed_weight')->nullable();
            $table->foreign('seed_id')->references('id')->on('seeds')->onUpdate('NO ACTION')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('seed_weights', function (Blueprint $table) {
            $table->dropForeign('seed_id');
            $table->dropColumn(
                'seed_id',
                '',
                'regeneration_evaluation',
                'fruit_mean_seeds_no',
                'thousand_fruit_weight',
                'thousand_seed_weight'
            );
        });
    }
}
