<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHerbariumTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('herbarium', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('number')->nullable()->comment('herbarium number
');
			$table->unsignedInteger('location_id')->index('fk_herbarium_location1_idx');
			$table->unsignedInteger('phenology_state_id')->nullable()->index('fk_herbarium_phenology_state1_idx');
			$table->unsignedInteger('protection_id')->nullable()->index('fk_herbarium_protection1_idx');
			$table->unsignedInteger('phytogeography_id')->nullable()->index('fk_herbarium_phytogeography1_idx');
			$table->unsignedInteger('organization_id')->index('fk_herbarium_organization1_idx');
			$table->integer('sheets_no')->nullable()->comment('Number of required sheets per herbarium sample');
			$table->integer('samples_no')->nullable()->comment('Quantity of samples of each herbarium number
 ');
			$table->integer('tip_qt')->nullable()->comment('number of tips
if tip_qt > 0, it meant we have the tip herbarium, otherwise means we don\'t have any tips related to this herbarium number
');
			$table->integer('physical_tip_qt')->nullable()->comment('it means how many physical tips we have.
if it is equal to zero, it means we don\'t have any physical tip and if tip_qt >0, it means we have image tips, rather than physical tips.
');
			$table->string('tip_type', 45)->nullable()->comment('it has the following types:
کلوتیپ
ایزوتیپ
پاراتیپ
لکتوتیپ
');
			$table->text('name')->nullable();
			$table->text('description')->nullable();
			$table->integer('is_flowering')->nullable()->comment('options:
yes or no
');
			$table->text('organization_description')->nullable();
			$table->integer('herbarium_tip_location')->nullable()->comment('location of keeping herbarium tip.
that is an herbarium organization which we can but its id in this place');
			$table->string('type_description', 45)->nullable()->comment('plant type description

');
			$table->unsignedInteger('plant_type_id')->nullable()->index('fk_herbarium_plant_type1_idx');
			$table->text('flowering')->nullable();
			$table->unsignedInteger('plantgroup_id')->nullable()->index('fk_herbarium_plantgroup1_idx');

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
		Schema::drop('herbarium');
	}

}
