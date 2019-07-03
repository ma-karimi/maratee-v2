<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPlanthubTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('planthub', function(Blueprint $table)
		{
			$table->foreign('author_id', 'fk_planthub_author1')->references('id')->on('author')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('location_id', 'fk_planthub_location1')->references('id')->on('location')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('protection_id', 'fk_planthub_protection1')->references('id')->on('protection')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('plantspecies_id', 'fk_plantsubspecies_has_author_plantspecies1')->references('id')->on('plantspecies')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('plantsubspecies_id', 'fk_plantsubspecies_has_author_plantsubspecies1')->references('id')->on('plantsubspecies')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('plantvariety_id', 'fk_plantsubspecies_has_author_plantvariety1')->references('id')->on('plantvariety')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('article_id', 'fk_plant_group_article1')->references('id')->on('article')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('person_id', 'fk_plant_group_person1')->references('id')->on('person')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('plant_id', 'fk_plant_group_plant1')->references('id')->on('plant')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('plantclass_id', 'fk_plant_group_plantclass1')->references('id')->on('plantclass')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('plantfamily_id', 'fk_plant_group_plantfamily1')->references('id')->on('plantfamily')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('plantgenus_id', 'fk_plant_group_plantgenus1')->references('id')->on('plantgenus')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('planthub', function(Blueprint $table)
		{
			$table->dropForeign('fk_planthub_author1');
			$table->dropForeign('fk_planthub_location1');
			$table->dropForeign('fk_planthub_protection1');
			$table->dropForeign('fk_plantsubspecies_has_author_plantspecies1');
			$table->dropForeign('fk_plantsubspecies_has_author_plantsubspecies1');
			$table->dropForeign('fk_plantsubspecies_has_author_plantvariety1');
			$table->dropForeign('fk_plant_group_article1');
			$table->dropForeign('fk_plant_group_person1');
			$table->dropForeign('fk_plant_group_plant1');
			$table->dropForeign('fk_plant_group_plantclass1');
			$table->dropForeign('fk_plant_group_plantfamily1');
			$table->dropForeign('fk_plant_group_plantgenus1');
		});
	}

}
