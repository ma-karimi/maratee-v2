<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrganizationDataToSeedCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('seed_collections', function (Blueprint $table) {
            if (!Schema::hasColumn('seed_collections', 'organization')) {
                Schema::disableForeignKeyConstraints();
                $table->dropConstrainedForeignId('organization_id');
                Schema::disableForeignKeyConstraints();
                $table->longText('organization')->nullable();
            }
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
