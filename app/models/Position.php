<?php

class Position extends Eloquent {
	
	protected $fillable = array('position_name','notes');	
	protected $guarted = array('position_id');
	
	public static $rules = array(
		'position_name'=>'required',
	);

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'positions';
	protected $primaryKey = 'position_id';



}