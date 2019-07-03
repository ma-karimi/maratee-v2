<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateConnectionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('connection', function(Blueprint $table)
		{
		    $table->increments('id');
			$table->integer('person_id')->index('fk_contact_has_address_person1_idx');
			$table->integer('organization_id')->index('fk_connection_organization1_idx');
			$table->integer('location_id')->nullable()->index('fk_connection_location1_idx');
			$table->integer('department_id')->index('fk_connection_department1_idx');

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
		Schema::drop('connection');
	}

}
