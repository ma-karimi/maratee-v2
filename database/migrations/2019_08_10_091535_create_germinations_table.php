<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGerminationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('germinations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('dormancy_breaking_treatments')->nullable();
            $table->date('light_date')->nullable();
            $table->date('dark_date')->nullable();
            $table->integer('light_temperature')->nullable();
            $table->integer('dark_temperature')->nullable();
            $table->date('dormancy_termination')->nullable();
            $table->integer('germination_period')->nullable();
            $table->integer('germination_percentage')->nullable();
            $table->float('germination_rate')->nullable();
            $table->date('germination_start')->nullable();
            $table->json('dormancy_breaking_description')->nullable();
            $table->timestampsTz();
            $table->softDeletesTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('germinations');
    }
}
