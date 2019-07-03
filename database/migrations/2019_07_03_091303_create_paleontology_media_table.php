<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaleontologyMediaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('paleontology_media', function(Blueprint $table)
		{
		    $table->increments('id');
			$table->unsignedInteger('gift_id')->nullable()->index('fk_paleontology_photo_gift1_idx');
			$table->unsignedInteger('expenses_id')->nullable()->index('fk_paleontology_photo_expenses1_idx');
			$table->unsignedInteger('purchase_id')->nullable()->index('fk_paleontology_photo_purchase1_idx');
			$table->unsignedInteger('correspondence_id')->nullable()->index('fk_paleontology_photo_correspondence1_idx');
			$table->unsignedInteger('paleontology_id')->nullable()->index('fk_paleontology_photo_paleontology1_idx');
			$table->unsignedInteger('media_id')->nullable()->index('fk_paleontology_media_media1_idx');
			$table->unsignedInteger('person_id')->nullable()->index('fk_paleontology_media_person1_idx');
			$table->unsignedInteger('exchange_id')->nullable()->index('fk_paleontology_media_exchange1_idx');
			$table->unsignedInteger('fair_id')->nullable()->index('fk_paleontology_media_fair1_idx');
			$table->text('state_id')->nullable();
			$table->text('creator_id')->nullable();
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
		Schema::drop('paleontology_media');
	}

}
