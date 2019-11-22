<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class ChangeMedicinesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('medicines', function($table)
        {
            $table->dropColumn('name', 'description', 'type', 'parent_id');
        });
        Schema::table('medicines', function($table)
        {
            $table->string('name_en');
            $table->string('name_fa')->nullable();
            $table->text('description')->nullable();

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
