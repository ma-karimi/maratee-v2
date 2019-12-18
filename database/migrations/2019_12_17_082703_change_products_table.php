<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class ChangeProductsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        Schema::dropIfExists('entry_hubs');
        Schema::dropIfExists('entries');
        Schema::dropIfExists('divisions');
        Schema::table('products', function(Blueprint $table)
        {
            $table->dropColumn('manufacturer');
            $table->string('company')->nullable();
            $table->string('address')->nullable();
            $table->string('telephone')->nullable();
            $table->text('side_effects')->nullable();
            $table->string('name_en');
            $table->string('name_fa')->nullable();
            $table->dropColumn('name');
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
