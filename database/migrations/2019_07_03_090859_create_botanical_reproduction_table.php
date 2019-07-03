<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBotanicalReproductionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('botanical_reproduction', function(Blueprint $table)
		{
		    $table->increments('id');
			$table->integer('botanical_id')->index('fk_botanical_has_reproduction_botanical1_idx');
			$table->integer('reproduction_id')->index('fk_botanical_has_reproduction_reproduction1_idx');
			$table->primary(['botanical_id','reproduction_id']);

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
		Schema::drop('botanical_reproduction');
	}

}
