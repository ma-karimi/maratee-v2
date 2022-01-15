<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddResearcherToSeedEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('seed_evaluations', function (Blueprint $table) {
            $table->string('research_leader_mobile')->nullable();
            $table->string('co_researcher_name')->nullable();
            $table->string('dormancy_breaking_treatments')->nullable();
            $table->string('date_started_test_year')->nullable();
            $table->string('date_started_test_day')->nullable();
            $table->string('date_started_test_month')->nullable();
            $table->string('date_started_germination_counting_year')->nullable();
            $table->string('date_started_germination_counting_month')->nullable();
            $table->string('date_started_germination_counting_day')->nullable();
            $table->longText('organization')->nullable();
            $table->dropColumn('started_test');
            $table->dropColumn('started_germination');
            Schema::disableForeignKeyConstraints();
            $table->dropConstrainedForeignId('dormancy_breaking_id');
            Schema::enableForeignKeyConstraints();
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
