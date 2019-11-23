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

        Schema::table('products', function($table)
        {
            $table->dropForeign(['organization_id']);
            $table->dropColumn('organization_id');
            $table->unsignedBigInteger('pharmaceutical_form_id')->nullable();
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
