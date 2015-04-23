<?php

use Illuminate\Database\Migrations\Migration;

class CreateCompanyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('companies', function($table){
			$table->increments('company_id');
			$table->string('company_name',50);
			$table->string('address');
			$table->string('city',255);
			$table->string('state',255);
			$table->string('country',255);
			$table->string('zipcode',10);
			$table->string('phone',20);
			$table->string('email',100);
			$table->string('notes',50);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('companies');
	}

}