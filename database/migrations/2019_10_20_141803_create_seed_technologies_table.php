<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSeedETechnologiesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seed_technologies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('seed_id');
            $table->unsignedBigInteger('seed_origin_id')->nullable();
            $table->date('date_received')->nullable();
            $table->tinyInteger('conserved_content')->comment('1:seed, 2: fruit, 3: both');

            $table->float('relative_humidity_percent', 4,2)->nullable()->comment('%');
            $table->float('purity_percent', 4,2)->nullable()->comment('%');
            $table->float('empty_impurity_seed_percent', 4,2)->nullable()->comment('%');
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
        Schema::drop('seed_technologies');
    }

}
