<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToHerbariumApplicationsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('herbarium_applications', function (Blueprint $table) {
            $table->foreign('general_application_id')->references('id')->on('generals')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('herbarium_id')->references('id')->on('herbariums')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('general_growth_id')->references('id')->on('generals')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('general_industry_id')->references('id')->on('generals')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('general_part_id')->references('id')->on('generals')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('general_usage_type_id')->references('id')->on('generals')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public
    function down()
    {
        Schema::table('herbarium_applications', function (Blueprint $table) {
            $table->dropForeign(['herbarium_id']);
            $table->dropForeign(['general_part_id']);
            $table->dropForeign(['general_application_id']);
            $table->dropForeign(['general_growth_id']);
            $table->dropForeign(['general_usage_type_id']);
            $table->dropForeign(['general_industry_id']);
        });
    }

}
