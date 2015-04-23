<?php
/**
* Get the option by value.
*
* @var string
*/
function get_option($value=''){
	$option = Option::where('option_name', '=', $value)->pluck('option_value');
	return $option;
}