<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToChromosomeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('chromosome', function(Blueprint $table)
		{
			$table->foreign('article_id', 'fk_chromosome_article1')->references('id')->on('articles')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('cryo_bank_id', 'fk_chromosome_cryo_bank1')->references('id')->on('cryo_bank')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('herbarium_id', 'fk_chromosome_herbarium1')->references('id')->on('herbarium')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('location_id', 'fk_chromosome_location1')->references('id')->on('location')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('chromosome', function(Blueprint $table)
		{
			$table->dropForeign('fk_chromosome_article1');
			$table->dropForeign('fk_chromosome_cryo_bank1');
			$table->dropForeign('fk_chromosome_herbarium1');
			$table->dropForeign('fk_chromosome_location1');
		});
	}

}
