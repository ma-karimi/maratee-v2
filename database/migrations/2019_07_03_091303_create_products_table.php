<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function(Blueprint $table)
		{
			$table->bigIncrements('id');
            $table->tinyInteger('registration_status')->comment('1:unregistered, 2: registered')->default(1);
            $table->unsignedBigInteger('organization_id');
			$table->string('components')->nullable();
            $table->text('consumption')->nullable();
            $table->text('active_compounds')->nullable();
            $table->string('company')->nullable();
            $table->string('address')->nullable();
            $table->string('telephone')->nullable();
            $table->text('side_effects')->nullable();
            $table->string('name_en');
            $table->string('name_fa')->nullable();
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
		Schema::drop('products');
	}

}
