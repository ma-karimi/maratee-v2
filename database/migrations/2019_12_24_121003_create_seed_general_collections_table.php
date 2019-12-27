<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSeedGeneralCollectionsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::table('seed_collections', function(Blueprint $table)
        {
            $table->dropForeign(['seed_id']);
            $table->dropForeign(['department_id']);
            $table->dropColumn(['department_id','seed_id', 'climate', 'community_type', 'associated_species', 'flowering_time_id', 'date_harvesting_id']);
            $table->string('harvesting_time')->nullable();
            $table->string('flowering_time')->nullable();
            $table->string('department_name')->nullable();
            $table->float('area_sampled', 5, 2)->nullable()->change();
            $table->float('approximate_area_of_plant', 5, 2)->nullable()->change();
            $table->string('approximate_area_of_plant', 5, 2)->nullable()->change();
            $table->float('plant_height', 5, 2)->nullable()->change();
            $table->boolean('dna')->default(0);
            $table->dateTimeTz('shipping_date')->nullable();
        });
        Schema::dropIfExists('molecular_evaluation_vars');
        Schema::dropIfExists('molecular_evaluations');
        Schema::dropIfExists('biochemical_evaluation_vars');
        Schema::dropIfExists('biochemical_evaluations');
        Schema::dropIfExists('seed_technologies');
        Schema::dropIfExists('technologies');
        Schema::dropIfExists('repeats');
        Schema::dropIfExists('medicinal_provinces');
        Schema::dropIfExists('medicinal_plant_properties');
        Schema::dropIfExists('medicinal_productions');
        Schema::dropIfExists('medicinal_references');
        Schema::dropIfExists('department_hubs');
        Schema::dropIfExists('departments');
        Schema::dropIfExists('evaluations');
        Schema::dropIfExists('components');
        Schema::dropIfExists('collections');
        Schema::dropIfExists('transaction_evidences');
        Schema::dropIfExists('action_hub_documents');
        Schema::dropIfExists('bio_moleculars');
        Schema::dropIfExists('villages');
        Schema::dropIfExists('soils');
        Schema::dropIfExists('seeds');

        \Illuminate\Support\Facades\DB::statement('DROP VIEW IF EXISTS scientific_view');
        \Illuminate\Support\Facades\DB::statement('DROP VIEW IF EXISTS species_authors_view');
        \Illuminate\Support\Facades\DB::statement('DROP VIEW IF EXISTS sub_species_authors_view');
        \Illuminate\Support\Facades\DB::statement('DROP VIEW IF EXISTS taxonomy_authors_view');
        \Illuminate\Support\Facades\DB::statement('DROP VIEW IF EXISTS variety_authors_view');

        Schema::create('seed_general_collections', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('seed_collection_id');
            $table->unsignedBigInteger('seed_general_id');
            $table->timestamps();
            $table->softDeletesTz();
        });
        Schema::enableForeignKeyConstraints();

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
