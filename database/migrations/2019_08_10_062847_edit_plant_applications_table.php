<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditPlantApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plant_applications', function (Blueprint $table) {
            $table->dropColumn('habitat_description');
            $table->dropColumn('ecology_description');
            $table->json('part_description')->nullable();
            $table->json('usage_description')->nullable();
            $table->json('industry_description')->nullable();
            $table->json('application_description')->nullable();
            $table->json('potential')->nullable();
            $table->unsignedInteger('department_id')->nullable();
            $table->foreign('department_id')->references('id')->on('departments')->onUpdate('NO ACTION')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plant_applications', function (Blueprint $table) {
            $table->dropForeign('department_id');
            $table->dropColumn(
                'part_description',
                'usage_description',
                'industry_description',
                'application_description',
                'potential',
                'department_id');
        });
    }
}
