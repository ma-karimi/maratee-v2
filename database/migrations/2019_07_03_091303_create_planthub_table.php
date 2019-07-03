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
			$table->unsignedInteger('plantsubspecies_id')->nullable()->index('fk_plantsubspecies_has_author_plantsubspecies1_idx');
			$table->unsignedInteger('plantvariety_id')->nullable()->index('fk_plantsubspecies_has_author_plantvariety1_idx');
			$table->unsignedInteger('plantspecies_id')->nullable()->index('fk_plantsubspecies_has_author_plantspecies1_idx');
			$table->unsignedInteger('plantfamily_id')->index('fk_plant_group_plantfamily1_idx');
			$table->unsignedInteger('plantgenus_id')->index('fk_plant_group_plantgenus1_idx');
			$table->unsignedInteger('plant_id')->index('fk_plant_group_plant1_idx');
			$table->unsignedInteger('person_id')->nullable()->index('fk_plant_group_person1_idx');
			$table->unsignedInteger('article_id')->nullable()->index('fk_plant_group_article1_idx');
			$table->unsignedInteger('plantclass_id')->nullable()->index('fk_plant_group_plantclass1_idx');
			$table->unsignedInteger('author_id')->nullable()->index('fk_planthub_author1_idx');
			$table->unsignedInteger('location_id')->nullable()->index('fk_planthub_location1_idx');
			$table->unsignedInteger('protection_id')->nullable()->index('fk_planthub_protection1_idx');
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
