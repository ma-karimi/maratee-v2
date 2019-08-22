<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditPaleontologiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('paleontologies', function (Blueprint $table) {
            $table->unsignedBigInteger('general_class_id');
            $table->unsignedBigInteger('general_order_id');
            $table->foreign('general_class_id')->references('id')->on('generals')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('general_order_id')->references('id')->on('generals')->onUpdate('NO ACTION')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('paleontologies', function (Blueprint $table) {
           $table->dropForeign('general_order_id');
           $table->dropForeign('general_class_id');
           $table->dropColumn('general_class_id','general_order_id');
        });
    }
}
