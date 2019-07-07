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
			$table->unsignedInteger('gift_id')->nullable();
			$table->unsignedInteger('expenses_id')->nullable();
			$table->unsignedInteger('purchase_id')->nullable();
			$table->unsignedInteger('correspondence_id')->nullable();
			$table->unsignedInteger('paleontology_id');
			$table->unsignedInteger('media_id');
			$table->unsignedInteger('person_id');
			$table->unsignedInteger('exchange_id')->nullable();
			$table->unsignedInteger('fair_id')->nullable();
			$table->json('status')->nullable();
			$table->integer('creator_id');
            $table->tinyInteger('status_id')->default(0);
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
