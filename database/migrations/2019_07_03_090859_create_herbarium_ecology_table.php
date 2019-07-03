<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHerbariumEcologyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('herbarium_ecology', function(Blueprint $table)
		{
	        $table->increments('id');
			$table->integer('herbarium_id')->index('fk_herbarium_has_ecology_herbarium1_idx');
			$table->integer('ecology_id')->index('fk_herbarium_has_ecology_ecology1_idx');
			$table->text('description')->nullable();
			$table->primary(['herbarium_id','ecology_id']);
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
		Schema::drop('herbarium_ecology');
	}

}
