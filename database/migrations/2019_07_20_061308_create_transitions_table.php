<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transitions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('table_name');
            $table->string('field_name');
            $table->integer('tables_id')->unsigned()->index();
            $table->integer('table_id');
            $table->integer('status');
            $table->integer('crud_type');
            $table->integer('creator_id')->unsigned()->index();
            $table->integer('requester_id')->unsigned()->index();
            $table->integer('changer_id')->unsigned()->index();
            $table->integer('responser_id')->unsigned()->index();
            $table->dateTime('request_date');
            $table->dateTime('change_date');
            $table->dateTime('response_date');
            $table->integer('request_status');
            $table->json('previous_value');
            $table->json('next_value');
            $table->json('description');
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
        Schema::dropIfExists('transitions');
    }
}
