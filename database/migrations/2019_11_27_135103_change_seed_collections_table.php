<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class ChangeSeedCollectionsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('seed_collections', function (Blueprint $table) {
            $table->unsignedBigInteger('taxonomy_id');
            $table->string('encoded_code_by_collector')->nullable();
            $table->string('corrected_code_by_nrgb')->nullable();
            $table->string('accession_code');
            $table->string('voucher_no')->nullable();
            $table->unsignedBigInteger('organization_id');
            $table->unsignedBigInteger('department_name')->nullable();
            $table->unsignedBigInteger('project_id')->nullable();
            $table->string('regeneration_and_evaluation_code')->nullable();
            $table->unsignedBigInteger('specimen_type_collect_id');
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
        //
    }

}
