<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSeedCollectionHubsTable extends Migration
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
            $table->dropColumn('department_id', 'climate', 'community_type', 'associated_species');
            $table->string('department_name')->nullable();
            $table->boolean('dna')->default(0);
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
        Schema::dropIfExists('collections');
        Schema::dropIfExists('transaction_evidences');
        Schema::dropIfExists('action_hub_documents');
        Schema::dropIfExists('bio_moleculars');

        Schema::create('seed_collection_hubs', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('seed_collection_id');
            $table->morphs('hub');
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
