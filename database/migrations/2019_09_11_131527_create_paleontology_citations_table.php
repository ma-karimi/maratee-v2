<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaleontologyCitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paleontology_citations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('paleontology_id');
            $table->unsignedBigInteger('author_id');
            $table->integer('year');
            $table->json('publication_name')->nullable();
            $table->string('volume')->nullable();
            $table->string('pages')->nullable();
            $table->string('plates')->nullable();
            $table->string('figures_number')->nullable();


            $table->foreign('paleontology_id')->references('id')->on('paleontologies')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('author_id')->references('id')->on('authors')->onUpdate('NO ACTION')->onDelete('CASCADE');

            $table->timestamps();
            $table->softDeletesTz();
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
