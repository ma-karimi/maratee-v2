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

            $table->string('regeneration_and_evaluation_code')->nullable();
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
