<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class ChangeBotanicalsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('botanicals', function (Blueprint $table) {
            $table->dropColumn('garden_id');
            $table->unsignedBigInteger('organization_id')->nullable();
            $table->unsignedBigInteger('internal_habitat_id')->nullable();
            $table->string('flowering_period')->nullable();

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
