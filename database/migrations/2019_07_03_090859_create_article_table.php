<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArticleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('article', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('title')->nullable();
			$table->date('year')->nullable();
			$table->text('journal_name')->nullable();
			$table->integer('journal_no')->nullable();
			$table->integer('page_no')->nullable();
			$table->text('type')->nullable();
			$table->text('authors')->nullable();

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
		Schema::drop('article');
	}

}
