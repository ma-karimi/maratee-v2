<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class ChangePaleontologyCitationsTable extends Migration
{


    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::rename('paleontology_citations', 'citations');
        Schema::table('citations', function(Blueprint $table)
        {
            $table->dropColumn(['paleontology_id']);
        });
        Schema::create('paleontology_citations', function(Blueprint $table)
        {
           $table->bigIncrements('id');
           $table->unsignedBigInteger('paleontology_id');
           $table->unsignedBigInteger('citation_id');
           $table->timestamps();
           $table->softDeletesTz();
        });
        Schema::dropIfExists('paleontology_documents');
        Schema::rename('paleontology_samples', 'paleontology_generals');
        Schema::table('paleontology_generals', function(Blueprint $table)
        {
            $table->unsignedBigInteger('sample_id', 'general_id')->change();
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
        Schema::dropIfExists('botanical_generals');
        Schema::dropIfExists('botanical_general_hubs');
        Schema::dropIfExists('botanical_colors');
    }

}
