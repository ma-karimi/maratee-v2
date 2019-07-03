<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSeedTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('seed', function(Blueprint $table)
		{
			$table->foreign('department_id', 'fk_seed_department1')->references('id')->on('department')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('herbarium_id', 'fk_seed_herbarium1')->references('id')->on('herbarium')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('protection_id', 'fk_seed_protection1')->references('id')->on('protection')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('seed', function(Blueprint $table)
		{
			$table->dropForeign('fk_seed_department1');
			$table->dropForeign('fk_seed_herbarium1');
			$table->dropForeign('fk_seed_protection1');
		});
	}

}
