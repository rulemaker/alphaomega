<?php

class Option extends Eloquent{
	
	protected $fillable = array('option_name',
															'option_value');	
	protected $guarted = array('option_id');
	
	public static $rules = array(
		'option_name'=>'required',
	);

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'options';
	protected $primaryKey = 'option_name';
	
	/**
   * Get option by value
   * @param $value
   * @return mixed
   */
	public function get_option( $value )
  {
      return $this->where('option_name', '=', $value)->pluck('option_value');
  }

}