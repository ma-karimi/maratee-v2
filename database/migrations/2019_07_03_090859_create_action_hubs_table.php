<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateActionHubsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('action_hubs', function(Blueprint $table)
		{
		    $table->bigIncrements('id');
			$table->integer('action_id')->default(1)->comment('1: detect, 2:collect, 3:research');
            $table->morphs('actionable');

            $table->date('date')->nullable();
			$table->text('description')->nullable();

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
		Schema::drop('action_hubs');
	}

}
