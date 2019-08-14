<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTransferCredentialsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('transfer_credentials', function(Blueprint $table)
		{
			$table->increments('id');
//            'herbarium, paleontology'
			$table->morphs('entitiable');
			$table->unsignedInteger('media_id')->nullable();
			$table->unsignedInteger('credential_id')->nullable();
            //            'visit, borrow, exchange'
            $table->morphs('transferable');

            $table->timeStampsTz();
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
		Schema::drop('transfer_credentials');
	}

}
