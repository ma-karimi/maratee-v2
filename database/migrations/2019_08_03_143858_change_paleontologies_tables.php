<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangePaleontologiesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \App\Utility::truncateTables();
        Schema::table('treatments', function (Blueprint $table){
           $table->dateTimeTz('date');
        });
        Schema::table('credentials', function (Blueprint $table) {
            $table->string('url')->nullable();
            $table->unsignedInteger('division_id')->nullable();
            $table->unsignedInteger('department_id');
            $table->foreign('department_id')->references('id')->on('departments')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('division_id')->references('id')->on('divisions')->onUpdate('NO ACTION')->onDelete('CASCADE');

        });
        Schema::table('maps', function (Blueprint $table){
            $table->string('name');
            $table->string('url')->nullable();
        });
        Schema::table('geology_ages', function (Blueprint $table){
            $table->dropColumn('era', 'period', 'epoch', 'stage');
            $table->json('name');
            $table->enum('type', ['era', 'period', 'epoch', 'stage']);
            $table->unsignedInteger('parent_id')->nullable();
        });
        Schema::table('plant_applications', function (Blueprint $table){
            $table->json('habitat_description')->nullable();
            $table->json('ecology_description')->nullable();
            $table->unsignedInteger('general_ecology_id');
            $table->unsignedInteger('general_habitat_id');
            $table->unsignedInteger('general_origin_id');
            $table->foreign('general_origin_id')->references('id')->on('generals')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('general_habitat_id')->references('id')->on('generals')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('general_ecology_id')->references('id')->on('generals')->onUpdate('NO ACTION')->onDelete('CASCADE');
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
        Schema::table('treatments', function (Blueprint $table){
            $table->dropColumn('date');
        });
        Schema::table('credentials', function (Blueprint $table) {
            $table->dropForeign(['division_id']);
            $table->dropForeign(['department_id']);
            $table->dropColumn('division_id', 'department_id','url');
        });
        Schema::table('maps', function (Blueprint $table){
            $table->dropColumn('name', 'url');
        });
        Schema::table('geology_ages', function (Blueprint $table){
            $table->dropColumn('name', 'type', 'parent_id');
            $table->json('era');
            $table->json('period');
            $table->json('epoch');
            $table->json('stage');
        });

        Schema::table('plant_applications', function (Blueprint $table) {
            $table->dropForeign(['general_ecology_id']);
            $table->dropForeign(['general_habitat_id']);
            $table->dropForeign(['general_origin_id']);
            $table->dropColumn('general_ecology_id', 'general_habitat_id','general_origin_id','habitat_description','ecology_description');
        });
    }

}
