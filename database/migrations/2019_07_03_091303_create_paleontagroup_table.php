<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaleontagroupTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('paleontagroup', function(Blueprint $table)
		{
		    $table->increments('id');
			$table->unsignedInteger('plantgroup_id')->index('fk_paleontagroup_plantgroup1_idx');
			$table->unsignedInteger('plantorder_id')->index('fk_paleontagroup_plantorder1_idx');
			$table->unsignedInteger('paleontology_id')->index('fk_paleontagroup_paleontology1_idx');
			$table->unsignedInteger('planthub_id')->index('fk_paleontagroup_planthub1_idx');
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
		Schema::drop('paleontagroup');
	}

}
