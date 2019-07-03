<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToBorrowTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('borrow', function(Blueprint $table)
		{
			$table->foreign('herbarium_id', 'fk_borrow_herbarium1')->references('id')->on('herbarium')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('media_id', 'fk_borrow_media1')->references('id')->on('media')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('person_id', 'fk_borrow_person1')->references('id')->on('person')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('borrow', function(Blueprint $table)
		{
			$table->dropForeign('fk_borrow_herbarium1');
			$table->dropForeign('fk_borrow_media1');
			$table->dropForeign('fk_borrow_person1');
		});
	}

}
