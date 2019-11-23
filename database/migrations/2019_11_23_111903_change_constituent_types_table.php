<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class ChangeConstituentTypesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('constituent_types', function (Blueprint $table) {
            $table->dropColumn('name', 'description');
        });
        Schema::table('constituent_types', function (Blueprint $table) {
            $table->string('name_en');
            $table->text('description');
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
