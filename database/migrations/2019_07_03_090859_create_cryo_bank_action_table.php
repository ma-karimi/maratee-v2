<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCryoBankActionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cryo_bank_action', function(Blueprint $table)
		{
		    $table->increments('id');
			$table->integer('cryo_bank_id')->index('fk_cryo_bank_has_action_cryo_bank1_idx');
			$table->integer('action_id')->index('fk_cryo_bank_has_action_action1_idx');
			$table->primary(['cryo_bank_id','action_id']);

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
		Schema::drop('cryo_bank_action');
	}

}
