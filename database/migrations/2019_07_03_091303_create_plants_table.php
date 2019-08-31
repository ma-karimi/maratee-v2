<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlantsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('plants', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->json('name');
			$table->json('description')->nullable();
			$table->json('domestic_name')->nullable();
			$table->tinyInteger('exclusivity')->nullable();
           // $table->unsignedBigInteger('taxonomy_id');
            //$table->unsignedBigInteger('classification_id');
            $table->unsignedBigInteger('flowering_id')->nullable();
            $table->unsignedBigInteger('cotyledon_id')->nullable();
            $table->unsignedBigInteger('sperm_id')->nullable();
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
		Schema::drop('plants');
	}

}
