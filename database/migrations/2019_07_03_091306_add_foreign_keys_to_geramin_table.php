<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToGeraminTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('geramin', function(Blueprint $table)
		{
			$table->foreign('collection_id', 'fk_geramin_collection1')->references('id')->on('collection')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('seed_id', 'fk_geramin_seed1')->references('id')->on('seed')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('geramin', function(Blueprint $table)
		{
			$table->dropForeign('fk_geramin_collection1');
			$table->dropForeign('fk_geramin_seed1');
		});
	}

}
