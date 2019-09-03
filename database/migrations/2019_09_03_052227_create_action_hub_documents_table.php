<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateActionHubDocumentsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('action_hub_documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('action_hub_id');
            $table->string('src');
            $table->text('src_description')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('action_hub_id')->references('id')->on('action_hubs')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('action_hub_documents');
    }
}
