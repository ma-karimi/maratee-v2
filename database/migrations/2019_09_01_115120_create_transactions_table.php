<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('organization_id');
            $table->dateTimeTz('start_time');
            $table->dateTimeTz('end_time')->nullable();
            $table->tinyInteger('type_id')->default(1)->comment('1: visit, 2: borrow, 3: exchange, 4:gift, 5:');
            $table->string('archive_no')->nullable();
            $table->json('description')->nullable();
            $table->json('purpose')->nullable();
            $table->tinyInteger('visit')->nullable()->comment('1: Sample, 2: All/Museum');
            $table->integer('peoples_no')->nullable();
            $table->json('person_position')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('organization_id')->references('id')->on('organizations')->onUpdate('NO ACTION')->onDelete('CASCADE');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
