<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHerbariumGrowthTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('herbarium_growth', function(Blueprint $table)
		{
		    $table->increments('id');
			$table->unsignedInteger('herbarium_id')->index('fk_herbarium_has_growth_herbarium1_idx');
			$table->unsignedInteger('growth_id')->index('fk_herbarium_has_growth_growth1_idx');
//			$table->primary(['herbarium_id','growth_id']);
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
		Schema::drop('herbarium_growth');
	}

}
