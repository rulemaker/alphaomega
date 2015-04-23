<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Periode extends Eloquent {
	
	protected $fillable = array('user_id',
															'position_id',
															'start_date',
															'end_date',
															'request_pay_date',
															'accept_pay_date',
															'salary',
															'notes');	
	protected $guarted = array('periode_id');
	
	public static $rules = array(
		'user_id'=>'required',
	);

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'periodes';
	protected $primaryKey = 'periode_id';


}