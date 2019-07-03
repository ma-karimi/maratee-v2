<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVisitTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('visit', function(Blueprint $table)
		{
			$table->increments('id');
			$table->unsignedInteger('person_id')->index('fk_visit_person1_idx');
			$table->dateTime('date')->nullable();
			$table->string('description', 45)->nullable();
			$table->string('purpose', 45)->nullable();
			$table->integer('peoples')->nullable();
			$table->string('archives_types', 45)->nullable();
			$table->string('archive_no', 45)->nullable();
			$table->unsignedInteger('paleontology_id')->nullable()->index('fk_visit_paleontology1_idx');
			$table->unsignedInteger('media_id')->nullable()->index('fk_visit_media1_idx');
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
		Schema::drop('visit');
	}

}
