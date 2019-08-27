<?php

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
        Schema::create('herbariums', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('number')->nullable()->comment('herbarium number
');
//			$table->unsignedBigInteger('location_id');

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
            //$table->json('name')->nullable();

            $table->json('description')->nullable();
            $table->tinyInteger('is_flowering')->default(0)->comment('options:
yes or no
');
            $table->json('organization_description')->nullable();
            $table->integer('herbarium_tip_location')->nullable()->comment('location of keeping herbarium tip.
that is an herbarium organization which we can but its id in this place');

            $table->string('flowering_time')->nullable();
            $table->unsignedBigInteger('protection_id');
            //  $table->unsignedBigInteger('department_id');

            //from generals table
            $table->unsignedBigInteger('general_ecology_id')->nullable();
            $table->unsignedBigInteger('general_habitat_id');
            $table->unsignedBigInteger('general_origin_id')->nullable();
//			$table->unsignedBigInteger('general_type_id')->nullable();
            $table->unsignedBigInteger('general_group_id')->nullable();
//			$table->unsignedBigInteger('general_growth_id')->nullable();
            $table->unsignedBigInteger('general_phenology_id')->nullable();
            $table->unsignedBigInteger('general_phytogeography_id');
            $table->json('life_forms')->comment('life_form_leaf_id', 'life_form_cycle_id', 'life_form_wooden_id', 'life_form_herbaceous_id');

          /*  $table->unsignedBigInteger('life_form_leaf_id')->virtualAs('life_forms->>"$.leaf_id"')->nullable();*/

            $table->json('habitat_description')->nullable();
            $table->json('ecology_description')->nullable();


            $table->unsignedBigInteger('organization_id');

            $table->nestedSet();

            $table->timeStampsTz();
            $table->softDeletesTz();
        });
        \Illuminate\Support\Facades\DB::statement('ALTER TABLE herbariums ADD life_form_cycle_id BIGINT GENERATED ALWAYS AS (reverse(life_forms)) VIRTUAL');
        \Illuminate\Support\Facades\DB::statement('ALTER TABLE herbariums ADD life_form_wooden_id BIGINT GENERATED ALWAYS AS (reverse(life_forms)) VIRTUAL');
        \Illuminate\Support\Facades\DB::statement('ALTER TABLE herbariums ADD life_form_herbaceous_id BIGINT GENERATED ALWAYS AS (reverse(life_forms)) VIRTUAL');
        \Illuminate\Support\Facades\DB::statement('ALTER TABLE herbariums ADD life_form_leaf_id BIGINT GENERATED ALWAYS AS (reverse(life_forms)) VIRTUAL');
        \Illuminate\Support\Facades\Schema::table('herbariums',function (Blueprint $table){
            $table->index('life_form_cycle_id');
            $table->index('life_form_wooden_id');
            $table->index('life_form_leaf_id');
            $table->index('life_form_herbaceous_id');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('herbariums', function (Blueprint $table) {
            $table->dropNestedSet();
        });
        Schema::drop('herbariums');
    }

}
