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
			$table->increments('id');
			$table->json('name');
			$table->json('description')->nullable();
			$table->json('domestic_name')->nullable();
            $table->unsignedInteger('plant_general_sub_specie_id')->nullable();
            $table->unsignedInteger('plant_general_variety_id')->nullable();
            $table->unsignedInteger('plant_general_specie_id')->nullable();
            $table->unsignedInteger('plant_general_class_id')->nullable();
            $table->unsignedInteger('plant_general_group_id')->nullable();
            $table->unsignedInteger('plant_general_order_id')->nullable();
            $table->unsignedInteger('plant_general_flowering_id')->nullable();
            $table->unsignedInteger('plant_general_sperm_id')->nullable();
            $table->unsignedInteger('plant_general_family_id');
            $table->unsignedInteger('plant_general_genus_id');
            $table->unsignedInteger('plant_general_cotyledon_id');

            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('article_id')->nullable();
            $table->unsignedInteger('author_id')->nullable();
            $table->unsignedInteger('location_id')->nullable();


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
		Schema::drop('plants');
	}

}
