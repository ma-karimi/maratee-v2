<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEntryHubTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('entry_hub', function(Blueprint $table)
		{
			$table->foreign('botanical_id', 'fk_entry_hub_botanical1')->references('id')->on('botanical')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('botanical_entry_id', 'fk_entry_hub_botanical_entry1')->references('id')->on('botanical_entry')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('location_id', 'fk_entry_hub_location1')->references('id')->on('location')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('organization_id', 'fk_entry_hub_organization1')->references('id')->on('organization')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('entry_hub', function(Blueprint $table)
		{
			$table->dropForeign('fk_entry_hub_botanical1');
			$table->dropForeign('fk_entry_hub_botanical_entry1');
			$table->dropForeign('fk_entry_hub_location1');
			$table->dropForeign('fk_entry_hub_organization1');
		});
	}

}
