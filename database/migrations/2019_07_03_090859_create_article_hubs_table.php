<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArticleHubsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('article_hubs', function(Blueprint $table)
		{
		    $table->increments('id');
			$table->unsignedInteger('person_id');
            $table->unsignedInteger('creator_id');
			$table->unsignedInteger('article_id');
			$table->unsignedInteger('action_id')->nullable();
			$table->unsignedInteger('location_id')->nullable();
			$table->unsignedInteger('cryo_bank_id')->nullable();
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
		Schema::drop('article_hubs');
	}

}
