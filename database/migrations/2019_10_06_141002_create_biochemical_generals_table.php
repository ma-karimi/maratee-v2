<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBiochemicalGeneralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biochemical_generals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->tinyInteger('type')->comment('1:specimen_type/collection_name');
            $table->timestamps();
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
        Schema::dropIfExists('biochemical_generals');
    }
}
