<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExoticGeneralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('exotic_generals')) {
            Schema::create('exotic_generals', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name');
                $table->enum('type', ['species', 'sub_species', 'variety', 'family', 'genus']);
                $table->timestamps();
                $table->softDeletesTz();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exotic_generals');
    }
}
