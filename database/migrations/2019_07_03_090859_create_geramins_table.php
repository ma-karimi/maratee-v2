<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGeraminsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('geramins', function(Blueprint $table)
		{
			$table->increments('id');
			$table->unsignedInteger('collection_id');
			$table->unsignedInteger('seed_id');
			$table->string('repeat', 45)->nullable();
			$table->integer('bush')->nullable();
			$table->integer('average')->nullable();
			$table->date('flowering_completion')->nullable();
			$table->date('gdd_flowering')->nullable();
			$table->integer('essence_rate')->nullable();
			$table->integer('bush_weight')->nullable();
			$table->integer('bush_height')->nullable();
			$table->integer('big_bush_diameter')->nullable();
			$table->integer('small_bush_diameter')->nullable();
			$table->integer('flowering_bish_qt')->nullable();
			$table->integer('crown_coverage')->nullable();
			$table->json('flower_color')->nullable();


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
		Schema::drop('geramins');
	}

}
