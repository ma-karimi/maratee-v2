<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPaleontologyMediaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('paleontology_media', function(Blueprint $table)
		{
			$table->foreign('exchange_id', 'fk_paleontology_media_exchange1')->references('id')->on('exchange')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('fair_id', 'fk_paleontology_media_fair1')->references('id')->on('fair')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('media_id', 'fk_paleontology_media_media1')->references('id')->on('media')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('person_id', 'fk_paleontology_media_person1')->references('id')->on('person')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('correspondence_id', 'fk_paleontology_photo_correspondence1')->references('id')->on('correspondence')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('expenses_id', 'fk_paleontology_photo_expenses1')->references('id')->on('expenses')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('gift_id', 'fk_paleontology_photo_gift1')->references('id')->on('gift')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('paleontology_id', 'fk_paleontology_photo_paleontology1')->references('id')->on('paleontology')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('purchase_id', 'fk_paleontology_photo_purchase1')->references('id')->on('purchase')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('paleontology_media', function(Blueprint $table)
		{
			$table->dropForeign('fk_paleontology_media_exchange1');
			$table->dropForeign('fk_paleontology_media_fair1');
			$table->dropForeign('fk_paleontology_media_media1');
			$table->dropForeign('fk_paleontology_media_person1');
			$table->dropForeign('fk_paleontology_photo_correspondence1');
			$table->dropForeign('fk_paleontology_photo_expenses1');
			$table->dropForeign('fk_paleontology_photo_gift1');
			$table->dropForeign('fk_paleontology_photo_paleontology1');
			$table->dropForeign('fk_paleontology_photo_purchase1');
		});
	}

}
