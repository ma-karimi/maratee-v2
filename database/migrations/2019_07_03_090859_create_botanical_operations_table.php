<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBotanicalOperationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('botanical_operations', function(Blueprint $table)
		{
            $table->bigIncrements('id');
			$table->unsignedBigInteger('botanical_id');
            $table->tinyInteger('operation_id')->comment('1:seeding, 2:planting');
            $table->unsignedBigInteger('garden_id');
            $table->date('date')->nullable();
			$table->string('number');
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
		Schema::drop('botanical_operations');
	}

}
