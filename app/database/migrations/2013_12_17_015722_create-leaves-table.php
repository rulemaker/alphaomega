<?php

use Illuminate\Database\Migrations\Migration;

class CreateLeavesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('leaves', function($table){
			$table->increments('leave_id');
			$table->integer('user_id');
			$table->integer('periode_id');
			$table->integer('day');
			$table->timestamp('start_date');
			$table->timestamp('end_date');
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