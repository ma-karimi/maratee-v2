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
		    $table->bigIncrements('id');
			$table->unsignedBigInteger('location_id')->nullable()->comment(' برای بررسی رویشگاه ان
');
			$table->unsignedBigInteger('entry_id')->comment('براس نوع ورود به باغ
');
			$table->unsignedBigInteger('botanical_id')->comment('گیاه در باغ');
			$table->unsignedBigInteger('organization_id')->nullable()->comment('سازمان یا باغ گیاه شناسی که نمونه از انجا می باشد.');

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
		Schema::drop('entry_hubs');
	}

}
