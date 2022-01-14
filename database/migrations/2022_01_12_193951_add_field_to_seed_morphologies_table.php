<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldToSeedMorphologiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('seed_morphologies', function (Blueprint $table) {
            $table->string('observation')->nullable();
            $table->string('sowing_date_year')->nullable();
            $table->string('sowing_date_month')->nullable();
            $table->string('sowing_date_day')->nullable();
            $table->string('observation_date_year')->nullable();
            $table->string('observation_date_month')->nullable();
            $table->string('observation_date_day')->nullable();
            $table->string('start_date_of_flowering_year')->nullable();
            $table->string('start_date_of_flowering_month')->nullable();
            $table->string('start_date_of_flowering_day')->nullable();
            $table->string('flowering_date_year')->nullable();
            $table->string('flowering_date_month')->nullable();
            $table->string('flowering_date_day')->nullable();
            $table->string('seed_ripening_date_year')->nullable();
            $table->string('seed_ripening_date_month')->nullable();
            $table->string('seed_ripening_date_day')->nullable();
            $table->string('describe_the_fieldgreenhouse_operations')->nullable();
            $table->string('other_detales')->nullable();
            $table->dropColumn('planting_date');
            $table->dropColumn('observation_date');
            $table->dropColumn('days_to_start_flowering');
            $table->dropColumn('days_to_flowering');
            $table->dropColumn('days_to_seed_ripening');
        });

        Schema::table('seed_morphology_fields', function (Blueprint $table) {
            $table->longText('location')->nullable();
            $table->string('field_or_greenhouse')->nullable();

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
