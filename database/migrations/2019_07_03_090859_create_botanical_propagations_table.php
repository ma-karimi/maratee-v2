<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBotanicalPropagationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('botanical_propagations', function(Blueprint $table)
		{
			$table->unsignedBigInteger('botanical_id');
			$table->unsignedBigInteger('propagation_id');


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
		Schema::drop('botanical_propagations');
	}

}
