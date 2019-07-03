<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSeedMolecularTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('seed_molecular', function(Blueprint $table)
		{
		    $table->increments('id');
			$table->integer('molecular_id');
			$table->integer('seed_id')->index('fk_seed_molecular_seed1_idx');
			$table->integer('location_id')->nullable()->index('fk_seed_molecular_location1_idx');
			$table->text('treatment')->nullable();
			$table->integer('repeat')->nullable();
			$table->primary(['molecular_id','seed_id']);
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
		Schema::drop('seed_molecular');
	}

}
