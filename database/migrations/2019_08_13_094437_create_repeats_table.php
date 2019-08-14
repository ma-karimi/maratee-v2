<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepeatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repeats', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('germination_id');
            $table->foreign('germination_id')->references('id')->on('germinations')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->integer('repeat');
            $table->date('date');
            $table->integer('count_no');
            $table->string('germination_number');
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
        Schema::dropIfExists('repeats');
    }
}
