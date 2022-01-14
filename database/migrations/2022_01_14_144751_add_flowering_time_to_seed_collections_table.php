<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFloweringTimeToSeedCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('seed_collections', function (Blueprint $table) {
            Schema::disableForeignKeyConstraints();
            $table->dropConstrainedForeignId('used_part_id');
            $table->dropConstrainedForeignId('taxonomy_id');
            $table->dropConstrainedForeignId('project_id');
            $table->dropConstrainedForeignId('location_id');
            Schema::enableForeignKeyConstraints();
            $table->dropColumn('shipping_date', 'harvesting_time_id', 'harvesting_time', 'department_name', 'organization_phone', 'organization_fax', 'organization_email');
            $table->string('flowering_time_month')->nullable();
            $table->string('date_harvesting_month')->nullable();
            $table->string('used_part')->nullable();
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
