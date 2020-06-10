<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCryoBankGeneralsTable extends Migration
{

    public $samples = ['seed', 'shoot', 'cell', 'embryo axis'];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cryobank_generals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('type');
            $table->timeStamps();
            $table->softDeletesTz();
        });

        foreach ($this->samples as $index => $sample) {
            \App\Models\CryobankGeneral::firstOrCreate(['name' => $sample, 'type' => 'sample']);
        }
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cryobank_generals');
    }

}
