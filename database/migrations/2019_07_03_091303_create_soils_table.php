<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSoilsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('soils', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->json('ph_type_id')->comment('neutral-alkaline-acid-indifferent');
			$table->json('features')->comment('clay soil%-loam%-fine sand%-coarse sand%- gravel%-shale%-salt%-gypsum%-forest soil%peat%-compost%-manure%-bone powder%');
			$table->json('description')->nullable();

            $table->timeStampsTz();
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
		Schema::drop('soils');
	}

}
