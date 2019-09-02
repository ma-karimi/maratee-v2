<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionHubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_hubs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->morphs('transactionable');
            $table->unsignedBigInteger('transaction_id');
            $table->tinyInteger('type_id')->default(1)->comment('1:send , 2:receive');
            $table->text('sheets_no')->nullable();
            $table->timestamps();
            $table->softDeletesTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_hubs');
    }
}
