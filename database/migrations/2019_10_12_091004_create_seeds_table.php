<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSeedsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seeds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('taxonomy_id');
            $table->string('encoded_code_by_collector')->nullable();
            $table->string('corrected_code_by_nrgb')->nullable();
            $table->string('accession_code')->nullable();
            $table->string('voucher_no')->nullable();
            $table->unsignedBigInteger('organization_id');
            $table->unsignedBigInteger('department_id')->nullable();
            $table->unsignedBigInteger('project_id')->nullable();
            $table->string('regeneration_and_evaluation_code')->nullable();
            $table->unsignedBigInteger('specimen_type_collect_id');
            $table->date('started_germination_test')->nullable();
            $table->string('dormancy_breaking_treatment')->nullable();
            $table->float('fresh_non_germinated_percent', 4, 2)->nullable();
            $table->float('rotten_seed_percent', 4, 2)->nullable();
            $table->float('abnormal_percent', 4, 2)->nullable();
            $table->float('germination_percent', 4, 2)->nullable();
            $table->float('viability_percent', 4, 2)->nullable();
            $table->string('germination_on_rate')->nullable();
            $table->date('date_banked')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletesTz();
            $table->foreign('taxonomy_id')->references('id')->on('taxonomies')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('specimen_type_collect_id')->references('id')->on('seed_generals')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('organization_id')->references('id')->on('organizations')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('department_id')->references('id')->on('departments')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('project_id')->references('id')->on('projects')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('seeds');
    }
}
