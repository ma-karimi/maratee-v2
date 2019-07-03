<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHerbariumHabitatTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('herbarium_habitat', function(Blueprint $table)
		{
		    $table->increments('id');
			$table->unsignedInteger('herbarium_id')->index('fk_herbarium_has_habitat_herbarium1_idx');
			$table->unsignedInteger('habitat_id')->index('fk_herbarium_has_habitat_habitat1_idx');
			$table->text('description')->nullable();
//			$table->primary(['herbarium_id','habitat_id']);
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
		Schema::drop('herbarium_habitat');
	}

}
