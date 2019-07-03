<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateChromosomeTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chromosome', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('n_no')->nullable();
            $table->integer('2n_no')->nullable();
            $table->text('notes')->nullable();
            $table->unsignedInteger('herbarium_id')->index('fk_chromosome_herbarium1_idx');
            $table->unsignedInteger('cryo_bank_id')->nullable()->index('fk_chromosome_cryo_bank1_idx');
            $table->unsignedInteger('article_id')->nullable()->index('fk_chromosome_article1_idx');
            $table->unsignedInteger('location_id')->nullable()->index('fk_chromosome_location1_idx');
            $table->integer('person_id');
            $table->tinyInteger('status_id')->default(0);
            $table->timeStampsTz();
            $table->dateTimeTz('deleted_at')->nullable();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('chromosome');
    }

}
