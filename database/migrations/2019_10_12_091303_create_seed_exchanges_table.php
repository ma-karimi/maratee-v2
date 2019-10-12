<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSeedExchangesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seed_exchanges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('organization_id');
            $table->unsignedBigInteger('department_id')->nullable();
            $table->unsignedBigInteger('project_id')->nullable();
            $table->unsignedBigInteger('specimen_type_collect_id')->nullable();
            $table->float('seed_weight', 4)->nullable();
            $table->date('delivery_date')->nullable();
            $table->string('accession_code')->nullable();
            $table->string('regeneration_and_evaluation_code')->nullable();
            $table->string('recipient_name');
            $table->string('recipient_phone');
            $table->string('request_no');
            $table->timeStampsTz();
            $table->softDeletesTz();
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
        Schema::drop('seed_exchanges');
    }

}
