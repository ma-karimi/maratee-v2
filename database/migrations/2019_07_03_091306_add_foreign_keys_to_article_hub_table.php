<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToArticleHubTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('article_hub', function(Blueprint $table)
		{
			$table->foreign('cryo_bank_id', 'fk_article_hub_cryo_bank1')->references('id')->on('cryo_bank')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('location_id', 'fk_article_hub_location1')->references('id')->on('location')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('action_id', 'fk_person_has_article_action1')->references('id')->on('action')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('article_id', 'fk_person_has_article_article1')->references('id')->on('article')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('person_id', 'fk_person_has_article_person1')->references('id')->on('person')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('article_hub', function(Blueprint $table)
		{
			$table->dropForeign('fk_article_hub_cryo_bank1');
			$table->dropForeign('fk_article_hub_location1');
			$table->dropForeign('fk_person_has_article_action1');
			$table->dropForeign('fk_person_has_article_article1');
			$table->dropForeign('fk_person_has_article_person1');
		});
	}

}
