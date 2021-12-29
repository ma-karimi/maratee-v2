<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSeedWeightIdToSeedExchangesTable extends Migration
{
    /** * Run the migrations. * * @return void */
    public function up()
    {
        Schema::table('seed_exchanges', function (Blueprint $table) {
            Schema::disableForeignKeyConstraints();
            \App\Models\SeedExchange::truncate();
            Schema::enableForeignKeyConstraints();
            if (!Schema::hasColumn('seed_exchanges', 'seed_weight_id')) {
                $table->foreignIdFor(\App\Models\SeedWeight::class, 'seed_weight_id')->constrained();
                $table->dropConstrainedForeignId('specimen_type_id');
            }

            $table->dropColumn('collection_id');
            $table->dropConstrainedForeignId('seed_collection_id');
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
            $table->dropConstrainedForeignId('seed_weight_id');
        });
    }
}
