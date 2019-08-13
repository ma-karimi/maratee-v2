<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->unsignedInteger('project_leader_id')->nullable();
            $table->unsignedInteger('research_leader_id')->nullable();
            $table->foreign('project_leader_id')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('research_leader_id')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
           $table->dropForeign('research_leader_id');
           $table->dropForeign('project_leader_id');
           $table->dropColumn('project_leader_id','research_leader_id');
        });
    }
}
