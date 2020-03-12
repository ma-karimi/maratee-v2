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

        Schema::table('geographicals', function (Blueprint $table) {
            $table->tinyInteger('type_id')->default(1)->comment('1: world, 2:iran');

        });
        Schema::table('medicines', function (Blueprint $table) {
            $table->unsignedBigInteger('taxonomy_id');

        });
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('taxonomy_id');

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
