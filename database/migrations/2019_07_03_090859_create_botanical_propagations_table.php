<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBotanicalPropagationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('botanical_propagations', function(Blueprint $table)
		{
		    $table->bigIncrements('id');
			$table->unsignedBigInteger('botanical_id');
			$table->tinyInteger('propagation_method_id')->comment('1:seed, 2:cutting, 3:graft, 4:natural, 5:natural regeneration, 6:root sucker, 7:collar sprout ');

            $table->timeStamps();
            $table->softDeletesTz();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('botanical_propagations');
	}

}
