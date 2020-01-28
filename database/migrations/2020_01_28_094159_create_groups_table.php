<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGroupsTable extends Migration
{


    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_en');
            $table->string('name_fa')->nullable();
            $table->json('permission')->nullable();

            $table->timeStamps();
            $table->softDeletesTz();

        });

        Schema::create('user_groups', function(Blueprint $table)
        {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('group_id');

            $table->timeStamps();
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
        Schema::dropIfExists('user_groups');
    }

}
