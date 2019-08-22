<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharactersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('seed_id');
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('project_id');
            $table->foreign('seed_id')->references('id')->on('seeds')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('department_id')->references('id')->on('departments')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('project_id')->references('id')->on('projects')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->string('regeneration_evaluation')->nullable();
            $table->string('voucher_no')->nullable();
            $table->string('type')->nullable();
            $table->softDeletesTz();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('characters');
    }
}
