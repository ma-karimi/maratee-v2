<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyToPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('permissions', function (Blueprint $table) {
            $table->foreign('department_id')->references('id')->on('departments')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('group_id')->references('id')->on('groups')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('requester_id')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('responser_id')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('permissions', function (Blueprint $table) {
            $table->dropForeign(['department_id']);
            $table->dropForeign(['user_id']);
            $table->dropForeign(['group_id']);
            $table->dropForeign(['role_id']);
            $table->dropForeign(['requester_id']);
            $table->dropForeign(['responser_id']);

        });
    }
}
