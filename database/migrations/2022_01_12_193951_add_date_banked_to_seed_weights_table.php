<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDateBankedToSeedWeightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('seed_weights', function (Blueprint $table) {
            $table->dropColumn('banked');
            $table->dropColumn('collected_seeds_no');
            $table->string('date_banked_year')->nullable();
            $table->string('date_banked_month')->nullable();
            $table->string('date_banked_day')->nullable();
            $table->longText('specimen_type_collections')->nullable();
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
