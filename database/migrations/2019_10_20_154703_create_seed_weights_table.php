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
        Schema::create('seed_weights', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('seed_id');
            $table->tinyInteger('mean_seeds_per_fruit')->nullable();
            $table->float('fruits_weight', 5, 2)->nullable()->nullable('1000 fruits');
            $table->float('seeds_weight', 5, 2)->nullable()->nullable('1000 seeds');
            $table->float('total_fruit_weight', 5, 2)->nullable();
            $table->float('total_seed_weight', 5, 2)->nullable();
            $table->tinyInteger('type_id')->comment('1:Seed weight in Active Collection, 2:Fruit weight in Active Collection, 3:Seed weight in Base Collection, 4:Fruit weight in Base Collection, 5:Seed weight in Duplicate Collection, 6: Fruit weight in Duplicate Collection, 7: Regenerated seed weight in Active Collection, 8:Regenerated fruit weight in Active Collection, 9:Regenerated seed weight in Base Collection, 10:Regenerated fruit weight in Base Collection, 11:Regenerated seed weight in Duplicate Collection, 12:Regenerated  fruit weight in Duplicate Collection');
            $table->float('value');
            $table->integer('collected_seeds_no');
            $table->text('other_detail')->nullable();
            $table->timeStamps();
            $table->softDeletesTz();
            $table->foreign('seed_id')->references('id')->on('seeds')->onUpdate('NO ACTION')->onDelete('CASCADE');

        });
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
