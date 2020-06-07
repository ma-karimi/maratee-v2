<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddProjectToSeedExchangesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('seed_exchanges', function (Blueprint $table) {
            $table->string('project_title')->nullable();
            $table->string('research_title')->nullable();
            $table->string('project_leader_name')->nullable();
            $table->string('research_leader_name')->nullable();
            $table->string('project_no')->nullable();
            $table->string('research_no')->nullable();
            $table->unsignedBigInteger('organization_id')->nullable()->change();
            $table->unsignedBigInteger('specimen_type_id')->nullable()->change();
            $table->date('delivery_date')->nullable()->change();

            $table->string('recipient_name')->nullable()->change();
//            $table->string('recipient_phone');
            $table->string('request_no')->nullable()->change();
            $table->dropForeign(['project_id']);
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }

}
