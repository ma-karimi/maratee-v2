<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddProjectToSeedMorphologiesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('seed_morphologies', function (Blueprint $table) {
            $table->string('project_title')->nullable();
            $table->string('research_title')->nullable();
            $table->string('project_leader_name')->nullable();
            $table->string('research_leader_name')->nullable();
            $table->string('project_no')->nullable();
            $table->string('research_no')->nullable();

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
