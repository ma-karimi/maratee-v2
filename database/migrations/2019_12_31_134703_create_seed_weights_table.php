<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSeedWeightsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists('seed_weights');
        Schema::create('seed_weights', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('collection_id');
            $table->unsignedBigInteger('seed_collection_id')->nullable();
            $table->string('accession_code')->nullable();
            $table->string('regeneration_code')->nullable();
            $table->string('row')->nullable();
            $table->string('column')->nullable();
            $table->string('fruit_humidity')->nullable();
            $table->string('seed_humidity')->nullable();
            $table->string('fruit_purity')->nullable();
            $table->string('seed_purity')->nullable();
            $table->tinyInteger('number_seeds_per_fruit')->nullable();
            $table->tinyInteger('range_seeds_per_fruit')->nullable();

            $table->string('thousand_fruits_weight')->nullable()->nullable('1000 fruits');
            $table->string('thousand_seeds_weight')->nullable()->nullable('1000 seeds');

            $table->string('total_fruit_weight')->nullable();
            $table->string('total_seed_weight')->nullable();
            $table->date('banked')->nullable();
            $table->integer('collected_seeds_no')->nullable();
            $table->text('description')->nullable();
            $table->timeStamps();
            $table->softDeletesTz();
            $table->foreign('seed_collection_id')->references('id')->on('seed_collections')->onUpdate('NO ACTION')->onDelete('CASCADE');

        });
        Schema::enableForeignKeyConstraints();

    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('seed_weights');
    }

}
