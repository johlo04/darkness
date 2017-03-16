<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation {

	public $CI;

	public function run($module = '', $group = '') {
		(is_object($module)) AND $this->CI = &$module;
		return parent::run($group);
	}
	
	public function video_duration_check($str){
		$this->CI->form_validation->set_message('video_duration_check', 'The {field} must be on valid time format: hh:mm:ss');

		if (1 == preg_match('/^([0-1]\d|2[0-3]):([0-5]\d):([0-5]\d)$/',$str))
		{
			
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function array_count_check($arr=array()){
		$this->CI->form_validation->set_message('array_count_check', 'Please choose atleast 1 from {field}');

		if (count($arr)>0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function empty_select_check($str){
		$this->CI->form_validation->set_message('empty_select_check', 'Please choose atleast 1 from {field}');

		if (!empty($str))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	

}

?>