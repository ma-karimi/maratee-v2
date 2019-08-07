<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeHerbariumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \App\Utility::truncateTables();
        Schema::table('divisions', function (Blueprint $table){
           $table->increments('id')->change();
        });
        Schema::table('herbariums', function (Blueprint $table) {
            $table->dropForeign(['organization_id']);
            $table->dropColumn('organization_id');
            $table->unsignedInteger('division_id')->nullable();
            $table->unsignedInteger('department_id');
            $table->foreign('department_id')->references('id')->on('departments')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('division_id')->references('id')->on('divisions')->onUpdate('NO ACTION')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \App\Utility::truncateTables();
        Schema::table('herbariums', function (Blueprint $table) {
            $table->dropForeign(['division_id']);
            $table->dropForeign(['department_id']);
            $table->dropColumn('division_id', 'department_id');
            $table->unsignedInteger('organization_id');
            $table->foreign('organization_id')->references('id')->on('organizations')->onUpdate('NO ACTION')->onDelete('cascade');
        });
    }

}
