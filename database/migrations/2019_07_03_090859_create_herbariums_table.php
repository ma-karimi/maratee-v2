<?php


use App\Libraries\CustomBlueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHerbariumsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('herbariums', function (Blueprint $table) {
//            $table->bigIncrements('id');
//            $table->string('number')->nullable()->comment('herbarium number
//');
////			$table->unsignedBigInteger('location_id');
//
//            $table->integer('sheets_no')->nullable()->comment('Number of required sheets per herbarium sample');
//            $table->integer('samples_no')->nullable()->comment('Quantity of samples of each herbarium number
// ');
//            $table->integer('tip_qt')->nullable()->comment('number of tips
//if tip_qt > 0, it meant we have the tip herbarium, otherwise means we don\'t have any tips related to this herbarium number
//');
//            $table->integer('physical_tip_qt')->nullable()->comment('it means how many physical tips we have.
//if it is equal to zero, it means we don\'t have any physical tip and if tip_qt >0, it means we have image tips, rather than physical tips.
//');
//
//            $table->json('description')->nullable();
////            $table->json('organization_description')->nullable();
////            $table->integer('herbarium_tip_location')->nullable()->comment('location of keeping herbarium tip.
////that is an herbarium organization which we can but its id in this place');
//
//
//            //  $table->unsignedBigInteger('department_id');
//
//
//            $table->unsignedBigInteger('organization_id');
//            $table->nestedSet();
//            $table->timeStampsTz();
//            $table->softDeletesTz();
//        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::table('herbariums', function (CustomBlueprint $table) {
//            $table->dropNestedSet();
//        });
//        Schema::drop('herbariums');
    }

}
