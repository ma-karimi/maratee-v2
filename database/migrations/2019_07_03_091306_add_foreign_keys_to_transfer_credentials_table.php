<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTransferCredentialsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('transfer_credentials', function(Blueprint $table)
		{
			$table->foreign('media_id')->references('id')->on('medias')->onUpdate('NO ACTION')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('transfer_credentials', function(Blueprint $table)
		{
			$table->dropForeign(['media_id']);

		});
	}

}
