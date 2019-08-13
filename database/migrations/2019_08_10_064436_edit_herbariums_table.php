<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditHerbariumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('herbariums', function (Blueprint $table) {
            $table->json('habitat_description');
            $table->json('ecology_description');
            $table->unsignedInteger('general_ecology_id');
            $table->unsignedInteger('general_habitat_id');
            $table->unsignedInteger('general_origin_id');
            $table->foreign('general_ecology_id')->references('id')->on('generals')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('general_habitat_id')->references('id')->on('generals')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('general_origin_id')->references('id')->on('generals')->onUpdate('NO ACTION')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('herbariums', function (Blueprint $table) {
            $table->dropForeign('general_ecology_id');
            $table->dropForeign('general_habitat_id');
            $table->dropForeign('general_origin_id');
            $table->dropColumn(
                'general_origin_id',
                'general_habitat_id',
                'general_ecology_id',
                'ecology_description',
                'habitat_description'
            );
        });
    }
}
