<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlanthubTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('planthub', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('plantsubspecies_id')->nullable()->index('fk_plantsubspecies_has_Author_plantsubspecies1_idx');
			$table->integer('plantvariety_id')->nullable()->index('fk_plantsubspecies_has_Author_plantvariety1_idx');
			$table->integer('plantspecies_id')->nullable()->index('fk_plantsubspecies_has_Author_plantspecies1_idx');
			$table->integer('plantfamily_id')->index('fk_plant_group_plantfamily1_idx');
			$table->integer('plantgenus_id')->index('fk_plant_group_plantgenus1_idx');
			$table->integer('plant_id')->index('fk_plant_group_plant1_idx');
			$table->integer('person_id')->nullable()->index('fk_plant_group_person1_idx');
			$table->integer('article_id')->nullable()->index('fk_plant_group_article1_idx');
			$table->integer('plantclass_id')->nullable()->index('fk_plant_group_plantclass1_idx');
			$table->integer('Author_id')->nullable()->index('fk_planthub_Author1_idx');
			$table->integer('location_id')->nullable()->index('fk_planthub_location1_idx');
			$table->integer('protection_id')->nullable()->index('fk_planthub_protection1_idx');
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
		Schema::drop('planthub');
	}

}
