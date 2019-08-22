<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMedicalComponentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('medical_components', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->unsignedBigInteger('component_id');
			$table->unsignedBigInteger('medical_id');
			$table->boolean('is_active');

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
		Schema::drop('medical_components');
	}

}
