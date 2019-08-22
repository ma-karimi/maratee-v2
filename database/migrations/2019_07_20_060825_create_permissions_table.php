<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('requester_id');
            $table->unsignedBigInteger('responser_id');
            $table->integer('permission_status');
            $table->dateTime('request_date');
            $table->dateTime('approval_date');
            $table->dateTime('expire_date');
            $table->json('owner_crud');
            $table->json('same_level_crud');
            $table->json('upper_level_crud');
            $table->json('lower_level_crud');
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
        Schema::dropIfExists('permissions');
    }
}
