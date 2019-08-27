<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToHerbariumsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('herbariums', function(Blueprint $table)
		{
//			$table->foreign('location_id')->references('id')->on('locations')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('protection_id')->references('id')->on('protections')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('organization_id')->references('id')->on('organizations')->onUpdate('NO ACTION')->onDelete('CASCADE');

            $table->foreign('general_ecology_id')->references('id')->on('generals')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('general_habitat_id')->references('id')->on('generals')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('general_origin_id')->references('id')->on('generals')->onUpdate('NO ACTION')->onDelete('cascade');
//            $table->foreign('general_type_id')->references('id')->on('generals')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('general_group_id')->references('id')->on('generals')->onUpdate('NO ACTION')->onDelete('cascade');
//            $table->foreign('general_growth_id')->references('id')->on('generals')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('general_phenology_id')->references('id')->on('generals')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('general_phytogeography_id')->references('id')->on('generals')->onUpdate('NO ACTION')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('herbariums', function(Blueprint $table)
		{
//			$table->dropForeign(['location_id']);
			$table->dropForeign(['protection_id']);
			$table->dropForeign(['organization_id']);

            $table->dropForeign(['general_ecology_id']);
            $table->dropForeign(['general_habitat_id']);
            $table->dropForeign(['general_origin_id']);
//            $table->dropForeign(['general_type_id']);
            $table->dropForeign(['general_group_id']);
//            $table->dropForeign(['general_growth_id']);
            $table->dropForeign(['general_phenology_id']);
            $table->dropForeign(['general_phytogeography_id']);
		});
	}

}
