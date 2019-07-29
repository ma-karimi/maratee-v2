<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPlantsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('plants', function(Blueprint $table)
		{
			$table->foreign('author_id')->references('id')->on('authors')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('location_id')->references('id')->on('locations')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('general_specie_id')->references('id')->on('generals')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('general_sub_specie_id')->references('id')->on('generals')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('general_variety_id')->references('id')->on('generals')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('article_id')->references('id')->on('articles')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('user_id')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');

			$table->foreign('general_class_id')->references('id')->on('generals')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('general_family_id')->references('id')->on('generals')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('general_genus_id')->references('id')->on('generals')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('general_sperm_id')->references('id')->on('generals')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('general_flowering_id')->references('id')->on('generals')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('general_order_id')->references('id')->on('generals')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('general_group_id')->references('id')->on('generals')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('general_cotyledon_id')->references('id')->on('generals')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('plants', function(Blueprint $table)
		{
			$table->dropForeign(['author_id']);
			$table->dropForeign(['location_id']);
			$table->dropForeign(['general_specie_id']);
			$table->dropForeign(['general_sub_specie_id']);
			$table->dropForeign(['general_variety_id']);
			$table->dropForeign(['article_id']);
			$table->dropForeign(['user_id']);

			$table->dropForeign(['general_class_id']);
			$table->dropForeign(['general_family_id']);
			$table->dropForeign(['general_sperm_id']);
			$table->dropForeign(['general_flowering_id']);
			$table->dropForeign(['general_order_id']);
			$table->dropForeign(['general_group_id']);
			$table->dropForeign(['general_cotyledon_id']);
		});
	}

}
