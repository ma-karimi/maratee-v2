<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddNotesPaleontologiesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('paleontologies', function (Blueprint $table) {
           $table->text('field_notes')->nullable();
            $table->dropColumn('location_in_collection', 'closet', 'salon');
        });

        Schema::table('paleontologies', function (Blueprint $table) {
            $table->string('location_in_collection')->nullable();
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
