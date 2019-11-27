<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class ChangeSeedPropertiesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('seeds', function (Blueprint $table) {
            $table->dropColumn('started_germination_test', 'dormancy_breaking_treatment', 'fresh_non_germinated_percent', 'rotten_seed_percent', 'abnormal_percent', 'germination_percent', 'viability_percent', 'germination_on_rate', 'date_banked');
        });

        Schema::table('seed_technologies', function (Blueprint $table){
            $table->date('started_germination_test')->nullable();
            $table->string('dormancy_breaking_treatment')->nullable();
            $table->float('fresh_non_germinated_percent', 4, 2)->nullable();
            $table->float('rotten_seed_percent', 4, 2)->nullable();
            $table->float('abnormal_percent', 4, 2)->nullable();
            $table->float('germination_percent', 4, 2)->nullable();
            $table->float('viability_percent', 4, 2)->nullable();
            $table->string('germination_on_rate')->nullable();
            $table->date('date_banked')->nullable();
            $table->date('light')->nullable();
            $table->date('dark')->nullable();
            $table->string('light_degree')->nullable()->comment('°C');
            $table->string('dark_degree')->nullable()->comment('°C');
            $table->date('dormancy_termination')->nullable();
            $table->date('germination_period')->nullable();
        });
        Schema::table('seed_evaluations', function (Blueprint $table){
            $table->date('started_germination_test')->nullable();
            $table->string('dormancy_breaking_treatment')->nullable();
            $table->float('germination_percent', 4, 2)->nullable();
            $table->float('viability_percent', 4, 2)->nullable();
            $table->date('light')->nullable();
            $table->date('dark')->nullable();
            $table->string('light_degree')->nullable()->comment('°C');
            $table->string('dark_degree')->nullable()->comment('°C');
            $table->date('dormancy_termination')->nullable();
            $table->date('germination_period')->nullable();
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
