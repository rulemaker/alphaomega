<?php

use Illuminate\Database\Migrations\Migration;

class CreateMaritalsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('maritals', function($table){
			$table->increments('marital_id');
			$table->string('marital_name',50);
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
		Schema::drop('maritals');
	}

}