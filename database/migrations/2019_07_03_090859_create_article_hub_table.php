<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArticleHubTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('article_hub', function(Blueprint $table)
		{
		    $table->increments('id');
			$table->unsignedInteger('person_id')->nullable()->index('fk_person_has_article_person1_idx');
			$table->unsignedInteger('article_id')->nullable()->index('fk_person_has_article_article1');
			$table->unsignedInteger('action_id')->nullable()->index('fk_person_has_article_action1_idx');
			$table->unsignedInteger('location_id')->nullable()->index('fk_article_hub_location1_idx');
			$table->unsignedInteger('cryo_bank_id')->nullable()->index('fk_article_hub_cryo_bank1_idx');
			$table->date('date')->nullable();
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
		Schema::drop('article_hub');
	}

}
