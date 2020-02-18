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
        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists('seed_exchanges');
        Schema::create('seed_exchanges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('seed_collection_id');
            $table->unsignedBigInteger('organization_id');
            $table->unsignedBigInteger('project_id');
            $table->string('regeneration_code')->nullable();
            $table->string('department_name')->nullable();

            //deleted by dr.jamzad
//            $table->string('organization_phone')->nullable();
//            $table->string('organization_fax')->nullable();
//            $table->string('organization_email')->nullable();
            $table->unsignedBigInteger('specimen_type_id');
            $table->unsignedBigInteger('collection_id');
            $table->float('weight', 5, 2)->nullable();
            $table->date('delivery_date');

            $table->string('recipient_name');
//            $table->string('recipient_phone');
            $table->string('request_no');
            $table->text('description')->nullable();
            $table->timeStamps();
            $table->softDeletesTz();
            $table->foreign('seed_collection_id')->references('id')->on('seed_collections')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('organization_id')->references('id')->on('organizations')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('project_id')->references('id')->on('projects')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('specimen_type_id')->references('id')->on('seed_generals')->onUpdate('NO ACTION')->onDelete('CASCADE');

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
        Schema::drop('seed_exchanges');
    }

}
