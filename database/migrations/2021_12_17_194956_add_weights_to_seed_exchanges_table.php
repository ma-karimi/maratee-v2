<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWeightsToSeedExchangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('seed_exchanges', function (Blueprint $table) {
            $table->dropColumn('weight');
            $table->double('seed_weight_value', 5, 2);
            $table->double('fruit_weight_value', 5, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('seed_exchanges', function (Blueprint $table) {
            $table->dropColumn(['seed_weight_Value', 'fruit_weight_value']);
            $table->double('weight', 5, 2);
        });
    }
}
