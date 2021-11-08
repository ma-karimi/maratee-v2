<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToSeedEvaluationsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('seed_evaluations', function (Blueprint $table) {
            $table->longText('germination_values')->default('[]');
            $table->longText('seedling_sizes')->default('[]');
            $table->longText('seed_sizes')->default('[]');
            $table->longText('traits')->default('[]');

        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('seed_evaluations', function (Blueprint $table) {
            $table->dropColumn(['germination_values', 'seedling_sizes', 'seed_sizes', 'traits']);
        });
    }

}
