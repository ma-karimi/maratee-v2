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
		    $table->bigIncrements('id');
		    $table->unsignedBigInteger('article_id');
		    //cryo_bank, media, action_hub, plant_herbarium, chromosome, medicinal_plant, paleontology
		    $table->morphs('articleable');

            $table->timeStamps();
            $table->softDeletesTz();
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
