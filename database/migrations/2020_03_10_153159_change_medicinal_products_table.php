<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class ChangeMedicinalProductsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('medicines', function (Blueprint $table) {
            $table->unsignedBigInteger('taxonomy_id');

        });
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('taxonomy_id')->nullable();

        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }

}
