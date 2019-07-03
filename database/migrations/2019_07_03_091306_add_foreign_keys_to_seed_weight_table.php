<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSeedWeightTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('seed_weight', function(Blueprint $table)
		{
			$table->foreign('seed_technology_id', 'fk_seed_weight_seed_technology1')->references('id')->on('seed_technology')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('seed_weight', function(Blueprint $table)
		{
			$table->dropForeign('fk_seed_weight_seed_technology1');
		});
	}

}
