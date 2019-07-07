<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCryoBankActionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cryo_bank_actions', function(Blueprint $table)
		{
			$table->unsignedInteger('cryo_bank_id');
			$table->unsignedInteger('action_id');

            $table->unsignedInteger('person_id');
			$table->unsignedInteger('creator_id');
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
		Schema::drop('cryo_bank_actions');
	}

}
