<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeliveryDateToSeedExchangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('seed_exchanges', function (Blueprint $table) {
            $table->string('delivery_date_year')->nullable();
            $table->string('delivery_date_month')->nullable();
            $table->string('delivery_date_day')->nullable();
            $table->double('seedfruit_weight')->nullable();
            $table->double('exchanged_weight')->nullable();
            $table->longText('organization')->nullable();
            $table->dropColumn('delivery_date');
            Schema::disableForeignKeyConstraints();
            $table->dropConstrainedForeignId('organization_id');
            $table->dropConstrainedForeignId('project_id');
            Schema::enableForeignKeyConstraints();
            $table->dropColumn('seed_weight_value');
            $table->dropColumn('fruit_weight_value');
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
