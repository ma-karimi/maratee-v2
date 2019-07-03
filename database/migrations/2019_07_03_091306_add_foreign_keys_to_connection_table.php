<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToConnectionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('connection', function(Blueprint $table)
		{
			$table->foreign('department_id', 'fk_connection_department1')->references('id')->on('department')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('location_id', 'fk_connection_location1')->references('id')->on('location')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('organization_id', 'fk_connection_organization1')->references('id')->on('organization')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('person_id', 'fk_contact_has_address_person1')->references('id')->on('person')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('connection', function(Blueprint $table)
		{
			$table->dropForeign('fk_connection_department1');
			$table->dropForeign('fk_connection_location1');
			$table->dropForeign('fk_connection_organization1');
			$table->dropForeign('fk_contact_has_address_person1');
		});
	}

}
