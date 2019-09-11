<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBotanicalGardenActionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('botanical_operations', function(Blueprint $table)
		{
			$table->unsignedBigInteger('botanical_id');
			$table->tinyInteger('operation_id')->comment('seeding-planting');
			$table->date('date')->nullable();
			$table->unsignedBigInteger('location_id');
			$table->string('number');
			$table->json('description')->nullable();
            $table->timeStampsTz();
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
		Schema::drop('botanical_operations');
	}

}
