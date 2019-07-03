<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSeedTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seed', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('herbarium_id')->index('fk_seed_herbarium1_idx');
            $table->integer('protection_id')->nullable()->index('fk_seed_protection1_idx');
            $table->integer('field_code')->nullable();
            $table->string('correct_field_code', 45)->nullable();
            $table->integer('sample_code')->nullable();
            $table->integer('voucher_no')->nullable();
            $table->text('transmittance')->nullable();
            $table->text('land_form')->nullable();
            $table->text('slope_direction')->nullable();
            $table->text('landscape')->nullable();
            $table->integer('slope_degree')->nullable();
            $table->text('soil_depth')->nullable();
            $table->text('density')->nullable();
            $table->text('drainage')->nullable();
            $table->text('soil_ph')->nullable();
            $table->text('salinity')->nullable();
            $table->text('lime')->nullable();
            $table->text('climate')->nullable();
            $table->text('extent_population')->nullable();
            $table->text('vegetation')->nullable();
            $table->text('soil_erosion')->nullable();
            $table->text('land_reforming')->nullable();
            $table->text('sample_type')->nullable();
            $table->text('flowering')->nullable();
            $table->text('pollination')->nullable();
            $table->text('pollination_agent')->nullable();
            $table->text('fruit_type')->nullable();
            $table->integer('seeding_bush_qt')->nullable();
            $table->text('collecting_type')->nullable();
            $table->text('seeding_month')->nullable();
            $table->text('reproduction')->nullable();
            $table->text('vegetative_form')->nullable();
            $table->integer('height')->nullable();
            $table->text('mother_health')->nullable();
            $table->integer('department_id')->nullable()->index('fk_seed_department1_idx');
            $table->date('send_date')->nullable();
            $table->integer('collected_qt')->nullable();
            $table->integer('must_collected_qt')->nullable();
            $table->integer('critical_extensions_qt')->nullable();
            $table->text('notes')->nullable();
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
        Schema::drop('seed');
    }

}
