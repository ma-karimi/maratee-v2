<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddProjectToSeedEvaluationsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('seed_evaluations', function (Blueprint $table) {
            $table->string('project_title')->nullable();
            $table->string('research_title')->nullable();
            $table->string('project_leader_name')->nullable();
            $table->string('research_leader_name')->nullable();
            $table->string('project_no')->nullable();
            $table->string('research_no')->nullable();

            $table->dropForeign(['project_id']);
            $table->dropForeign(['seed_collection_id']);
            $table->dropForeign(['specimen_type_id']);
            $table->dropColumn(['project_id', 'seed_collection_id', 'specimen_type_id']);
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
