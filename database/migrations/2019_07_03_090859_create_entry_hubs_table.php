<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEntryHubsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('entry_hubs', function(Blueprint $table)
		{
		    $table->increments('id');
			$table->unsignedInteger('location_id')->nullable()->comment(' برای بررسی رویشگاه ان
');
			$table->unsignedInteger('entry_id')->comment('براس نوع ورود به باغ
');
			$table->unsignedInteger('botanical_id')->comment('گیاه در باغ');
			$table->unsignedInteger('organization_id')->nullable()->comment('سازمان یا باغ گیاه شناسی که نمونه از انجا می باشد.');

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
		Schema::drop('entry_hubs');
	}

}
