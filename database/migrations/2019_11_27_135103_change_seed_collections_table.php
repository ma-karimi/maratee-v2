<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class ChangeSeedCollectionsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('seed_collections', function (Blueprint $table) {
            $table->dropForeign(['organization_id']);
            $table->dropForeign(['department_id']);
            $table->dropForeign(['project_id']);
            $table->dropForeign(['specimen_type_collect_id']);
            $table->dropColumn('organization_id', 'department_id', 'project_id', 'specimen_type_collect_id', 'regeneration_and_evaluation_code');
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
