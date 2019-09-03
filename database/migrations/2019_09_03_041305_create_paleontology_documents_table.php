<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaleontologyDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paleontology_documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('paleontology_id');
            $table->string('src');
            $table->text('src_description')->nullable();
            $table->timestamps();
            $table->softDeletesTz();

            $table->foreign('paleontology_id')->references('id')->on('paleontologies')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paleontology_documents');
    }
}
