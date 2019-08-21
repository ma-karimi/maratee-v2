<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTransferMediasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('transfer_medias', function(Blueprint $table)
		{
			$table->increments('id');
            $table->unsignedInteger('media_id');
            $table->unsignedInteger('transfer_id');
            $table->timeStampsTz();
            $table->softDeletesTz();

            $table->foreign('media_id')->references('id')->on('medias')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('transfer_id')->references('id')->on('transfers')->onUpdate('NO ACTION')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('transfer_medias', function($table)
        {
            $table->dropForeign(['media_id']);
            $table->dropForeign(['transfer_id']);
        });
        Schema::drop('transfer_medias');
	}

}
