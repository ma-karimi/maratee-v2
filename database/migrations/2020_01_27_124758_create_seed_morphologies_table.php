<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeedMorphologiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::dropIfExists('morphology_quantitative_evaluations');
        Schema::dropIfExists('morphology_qualitative_evaluations');
        Schema::dropIfExists('morphology_variables');
        Schema::create('seed_morphologies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('seed_collection_id')->nullable();
            $table->string('accession_code')->nullable();

            $table->unsignedBigInteger('specimen_type_id');
            $table->unsignedBigInteger('field_id')->nullable();
            $table->unsignedBigInteger('collection_id');
            $table->unsignedBigInteger('organization_id')->nullable();
            $table->string('regeneration_code')->nullable();

            $table->string('department_name')->nullable();
            $table->unsignedBigInteger('replication_or_block_number')->nullable();
            $table->string('plant_density')->nullable();
            $table->string('observation_no')->nullable();
            $table->date('planting_date')->nullable();
            $table->date('observation_date')->nullable();
            $table->integer('days_to_start_flowering')->nullable();
            $table->integer('days_to_flowering')->nullable();
            $table->integer('days_to_seed_ripening')->nullable();
            $table->timeStamps();
            $table->softDeletesTz();
            $table->foreign('seed_collection_id')->references('id')->on('seed_collections')->onUpdate('NO ACTION')->onDelete('CASCADE');

            $table->foreign('specimen_type_id')->references('id')->on('seed_generals')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('collection_id')->references('id')->on('seed_generals')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('organization_id')->references('id')->on('organizations')->onUpdate('NO ACTION')->onDelete('CASCADE');
//            $table->foreign('field_id')->references('id')->on('seed_morphology_fields')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });

        Schema::create('morphology_variables', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('seed_morphology_id');
            $table->unsignedBigInteger('seed_general_id');
            $table->string('value');
            $table->timeStamps();
            $table->softDeletesTz();
            $table->foreign('seed_general_id')->references('id')->on('seed_generals')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('seed_morphology_id')->references('id')->on('seed_morphologies')->onUpdate('NO ACTION')->onDelete('CASCADE');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seed_morphologies');
        Schema::dropIfExists('seed_morphology_variables');
    }
}
