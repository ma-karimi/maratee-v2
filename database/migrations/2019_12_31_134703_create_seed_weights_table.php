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
            $table->unsignedBigInteger('seed_collection_id');
            $table->unsignedBigInteger('refrigerator_id');
            $table->string('regeneration_code')->nullable();
            $table->string('row')->nullable();
            $table->string('column')->nullable();
            $table->float('fruit_humidity', 5,2)->nullable();
            $table->float('seed_humidity', 5,2)->nullable();
            $table->float('fruit_purity', 5,2)->nullable();
            $table->float('seed_purity', 5,2)->nullable();
            $table->tinyInteger('number_seeds_per_fruit')->nullable();
            $table->tinyInteger('range_seeds_per_fruit')->nullable();

            $table->float('thousand_fruits_weight', 5, 2)->nullable()->nullable('1000 fruits');
            $table->float('thousand_seeds_weight', 5, 2)->nullable()->nullable('1000 seeds');

            $table->float('total_fruit_weight', 5, 2)->nullable();
            $table->float('total_seed_weight', 5, 2)->nullable();
            $table->date('banked')->nullable();
            $table->integer('collected_seeds_no')->nullable();
            $table->text('description')->nullable();
            $table->timeStamps();
            $table->softDeletesTz();
            $table->foreign('seed_collection_id')->references('id')->on('seed_collections')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('refrigerator_id')->references('id')->on('seed_generals')->onUpdate('NO ACTION')->onDelete('CASCADE');

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
