<?php

class Department extends Eloquent {
	
	protected $fillable = array('department_name','notes');	
	protected $guarted = array('department_id');
	
	public static $rules = array(
		'department_name'=>'required',
	);

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'departments';
	protected $primaryKey = 'department_id';



}