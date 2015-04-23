<?php

use Illuminate\Database\Migrations\Migration;

class CreatePeriodesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('periodes', function($table){
			$table->increments('periode_id');
			$table->integer('user_id');
			$table->integer('position_id');
			$table->timestamp('start_date');
			$table->timestamp('end_date');
			$table->timestamp('request_pay_date');
			$table->timestamp('accept_pay_date');
			$table->float('salary');
			$table->string('status',11);
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
		Schema::drop('periodes');
	}

}