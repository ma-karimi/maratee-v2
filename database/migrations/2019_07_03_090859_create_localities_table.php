<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLocalitiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('localities', function(Blueprint $table)
		{
		    $table->bigIncrements('id');
			$table->unsignedBigInteger('paleontology_id');
			$table->unsignedBigInteger('location_id');
			$table->string('formation')->nullable();
			$table->string('thickness')->nullable();
			$table->string('stratigraphy')->nullable();
			$table->string('lithology')->nullable();
			$table->string('fauna')->nullable();
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
		Schema::drop('localities');
	}

}
