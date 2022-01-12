<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLocationDataToSeedCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('seed_collections', function (Blueprint $table) {
            if (!Schema::hasColumn('specimen_type_id', 'location')) {
                Schema::disableForeignKeyConstraints();
                $table->dropConstrainedForeignId('specimen_type_collect_id');
                $table->foreignIdFor(\App\Models\SeedGeneral::class, 'specimen_type_id')->nullable()->constrained('seed_generals')->nullOnDelete();
                $table->foreignIdFor(\App\Models\SeedGeneral::class, 'pollination_type_id')->nullable()->constrained('seed_generals')->nullOnDelete();
                $table->foreignIdFor(\App\Models\SeedGeneral::class, 'pollination_agent_id')->nullable()->constrained('seed_generals')->nullOnDelete();
                $table->foreignIdFor(\App\Models\SeedGeneral::class, 'used_part_id')->nullable()->constrained('seed_generals')->nullOnDelete();
                Schema::disableForeignKeyConstraints();
                $table->longText('location')->nullable();
                $table->string('shipping_date_year')->nullable();
                $table->string('shipping_date_month')->nullable();
                $table->string('shipping_date_day')->nullable();
                $table->string('community_type')->nullable();
                $table->string('associated_species')->nullable();
                $table->string('how_to_use')->nullable();
                $table->string('climate')->nullable();
                $table->string('special_advice_on_seed')->nullable();
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
