<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaelontologyMediaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('paelontology_media', function(Blueprint $table)
		{
		    $table->increments('id');
			$table->integer('gift_id')->nullable()->index('fk_paelontology_photo_gift1_idx');
			$table->integer('expenses_id')->nullable()->index('fk_paelontology_photo_expenses1_idx');
			$table->integer('purchase_id')->nullable()->index('fk_paelontology_photo_purchase1_idx');
			$table->integer('correspondance_id')->nullable()->index('fk_paelontology_photo_correspondance1_idx');
			$table->integer('paleontology_id')->nullable()->index('fk_paelontology_photo_paleontology1_idx');
			$table->integer('media_id')->nullable()->index('fk_paelontology_media_media1_idx');
			$table->integer('person_id')->nullable()->index('fk_paelontology_media_person1_idx');
			$table->integer('exchange_id')->nullable()->index('fk_paelontology_media_exchange1_idx');
			$table->integer('fair_id')->nullable()->index('fk_paelontology_media_fair1_idx');
			$table->text('state_id')->nullable();
			$table->text('creator_id')->nullable();
            $table->integer('person_id');
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
		Schema::drop('paelontology_media');
	}

}
