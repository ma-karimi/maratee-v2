<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHerbariumsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('herbariums', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('herbarium_number')->nullable();
            $table->string('herbarium_index')->nullable();
            $table->string('cf')->nullable();
            $table->unsignedBigInteger('location_id')->nullable();
            $table->unsignedBigInteger('organization_id');
            $table->unsignedBigInteger('taxonomy_id');
            $table->text('description')->nullable();
            $table->boolean('tip_picture_id')->nullable();

            $table->timeStamps();
            $table->softDeletesTz();
            $table->foreign('location_id')->references('id')->on('locations')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('organization_id')->references('id')->on('organizations')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('taxonomy_id')->references('id')->on('taxonomies')->onUpdate('NO ACTION')->onDelete('CASCADE');

        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('herbariums');
    }

}
