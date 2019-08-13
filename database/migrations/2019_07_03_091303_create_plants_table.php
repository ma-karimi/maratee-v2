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
            $table->unsignedInteger('general_sub_specie_id')->nullable();
            $table->unsignedInteger('general_variety_id')->nullable();
            $table->unsignedInteger('general_specie_id')->nullable();
            $table->unsignedInteger('general_class_id')->nullable();
            $table->unsignedInteger('general_group_id')->nullable();
            $table->unsignedInteger('general_order_id')->nullable();
            $table->unsignedInteger('general_flowering_id')->nullable();
            $table->unsignedInteger('general_sperm_id')->nullable();
            $table->unsignedInteger('general_family_id');
            $table->unsignedInteger('general_genus_id');
            $table->unsignedInteger('general_cotyledon_id');
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('article_id')->nullable();
            $table->unsignedInteger('location_id')->nullable();
            $table->string('exclusivity')->nullable();
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
