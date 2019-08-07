<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPaleontologyMediasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('paleontology_medias', function(Blueprint $table)
		{
			$table->foreign('exchange_id')->references('id')->on('exchanges')->onUpdate('NO ACTION')->onDelete('cascade');
			$table->foreign('credential_fair_id')->references('id')->on('credentials')->onUpdate('NO ACTION')->onDelete('cascade');
			$table->foreign('media_id')->references('id')->on('medias')->onUpdate('NO ACTION')->onDelete('cascade');
			$table->foreign('user_id')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('cascade');

			$table->foreign('credential_correspondence_id')->references('id')->on('credentials')->onUpdate('NO ACTION')->onDelete('cascade');
			$table->foreign('credential_expense_id')->references('id')->on('credentials')->onUpdate('NO ACTION')->onDelete('cascade');
			$table->foreign('credential_gift_id')->references('id')->on('credentials')->onUpdate('NO ACTION')->onDelete('cascade');
			$table->foreign('paleontology_id')->references('id')->on('paleontologies')->onUpdate('NO ACTION')->onDelete('cascade');
			$table->foreign('credential_purchase_id')->references('id')->on('credentials')->onUpdate('NO ACTION')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('paleontology_medias', function(Blueprint $table)
		{
			$table->dropForeign(['exchange_id']);
			$table->dropForeign(['credential_fair_id']);
			$table->dropForeign(['media_id']);
			$table->dropForeign(['user_id']);

			$table->dropForeign(['credential_correspondence_id']);
			$table->dropForeign(['credential_expense_id']);
			$table->dropForeign(['credential_gift_id']);
			$table->dropForeign(['paleontology_id']);
			$table->dropForeign(['credential_purchase_id']);
		});
	}

}
