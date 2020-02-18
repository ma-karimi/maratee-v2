<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSeedEvaluationsTable extends Migration
{

    /**
     * Run the migsrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists('seed_evaluations');
        Schema::create('seed_evaluations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('seed_collection_id');
//            $table->unsignedBigInteger('organization_id');
            $table->unsignedBigInteger('project_id');
//            $table->string('department_name')->nullable();
//            $table->string('organization_phone')->nullable();
//            $table->string('organization_fax')->nullable();
//            $table->string('organization_email')->nullable();
            $table->unsignedBigInteger('specimen_type_id');
            $table->unsignedBigInteger('collection_id');
            $table->string('regeneration_code')->nullable();
            $table->integer('number_of_exchanged_seeds')->nullable();
            $table->integer('light_hr')->nullable();
            $table->integer('light_c')->nullable();
            $table->integer('dark_hr')->nullable();
            $table->integer('dark_c')->nullable();

            $table->date('started_test')->nullable();
            $table->date('started_germination')->nullable();
            $table->integer('repeat')->nullable();
            $table->integer('planted_seeds')->nullable();
            $table->integer('dormancy_termination')->nullable()->comment('day');
            $table->integer('germination_period')->nullable()->comment('day');
            $table->integer('fresh_non_germinated')->nullable();
            $table->integer('rotten_seed')->nullable();
            $table->integer('abnormal')->nullable();
            $table->integer('germinated_number')->nullable();
            $table->float('seedling_mortality', 5,2)->nullable()->comment('percent');
//            $table->float('germination', 5,2)->nullable();
//            $table->float('viability', 5,2)->nullable();
            $table->float('mean_fresh_seedling_weight', 5,2)->nullable();
            $table->float('mean_dry_seedling_weight', 5,2)->nullable()->comment('g, in 10 seedlings');
            $table->float('dry_matter', 5, 2)->nullable()->comment('%');
            $table->unsignedBigInteger('dormancy_breaking_id')->nullable();
            $table->text('describe_dormancy_treatment')->nullable();
            $table->text('description')->nullable();

            //dr.jamzad changes
            $table->float('min_radical', 4, 2)->nullable();
            $table->float('max_radical', 4, 2)->nullable();
            $table->float('min_shoot', 4, 2)->nullable();
            $table->float('max_shoot', 4, 2)->nullable();
            $table->float('min_seed', 4, 2)->nullable();
            $table->float('max_seed', 4, 2)->nullable();
            $table->float('min_seed_width', 4, 2)->nullable();
            $table->float('max_seed_width', 4, 2)->nullable();

            $table->timeStamps();
            $table->softDeletesTz();
            $table->foreign('seed_collection_id')->references('id')->on('seed_collections')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('specimen_type_id')->references('id')->on('seed_generals')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('dormancy_breaking_id')->references('id')->on('seed_generals')->onUpdate('NO ACTION')->onDelete('CASCADE');
//            $table->foreign('organization_id')->references('id')->on('organizations')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('project_id')->references('id')->on('projects')->onUpdate('NO ACTION')->onDelete('CASCADE');

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
        Schema::drop('seed_evaluations');
    }

}
