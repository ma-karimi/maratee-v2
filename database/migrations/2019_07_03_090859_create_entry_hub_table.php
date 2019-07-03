<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEntryHubTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('entry_hub', function(Blueprint $table)
		{
		    $table->increments('id');
			$table->unsignedInteger('location_id')->nullable()->index('fk_entry_hub_location1_idx')->comment(' برای بررسی رویشگاه ان
');
			$table->unsignedInteger('botanical_entry_id')->nullable()->index('fk_entry_hub_botanical_entry1_idx')->comment('براس نوع ورود به باغ
');
			$table->unsignedInteger('botanical_id')->index('fk_entry_hub_botanical1_idx')->comment('گیاه در باغ');
			$table->unsignedInteger('organization_id')->nullable()->index('fk_entry_hub_organization1_idx')->comment('سازمان یا باغ گیاه شناسی که نمونه از انجا می باشد.');
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
		Schema::drop('entry_hub');
	}

}
