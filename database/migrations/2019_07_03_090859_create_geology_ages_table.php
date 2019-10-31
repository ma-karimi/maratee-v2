<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGeologyAgesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('geology_ages', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->string('name');
			$table->tinyInteger('type_id')->comment('1:era, 2:period, 3:epoch, 4:stage');
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
		Schema::drop('geology_ages');
	}

}
