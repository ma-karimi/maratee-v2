<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaleontologyMediasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('paleontology_medias', function(Blueprint $table)
		{
			$table->unsignedInteger('credential_gift_id')->nullable();
			$table->unsignedInteger('credential_expense_id')->nullable();
			$table->unsignedInteger('credential_purchase_id')->nullable();
			$table->unsignedInteger('credential_correspondence_id')->nullable();
			$table->unsignedInteger('paleontology_id');
			$table->unsignedInteger('media_id');
			$table->unsignedInteger('user_id');
			$table->unsignedInteger('exchange_id')->nullable();
			$table->unsignedInteger('credential_fair_id')->nullable();

            $table->timeStampsTz();
            $table->dateTimeTz('deleted_at')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('paleontology_medias');
	}

}
