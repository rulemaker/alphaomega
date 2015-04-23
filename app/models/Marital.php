<?php

class Marital extends Eloquent {
	
	protected $fillable = array('marital_name','notes');	
	protected $guarted = array('marital_id');
	
	public static $rules = array(
		'marital_name'=>'required',
	);

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'maritals';
	protected $primaryKey = 'marital_id';



}