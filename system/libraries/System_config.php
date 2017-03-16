<?php
/** 
 * CodeIgniter
 *
 * @copyright	Copyright (c) Flax, Inc. (https://flax.ph/)
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * System Config class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @author		Jolo Pedrocillo
 */
 
class CI_System_config {
	
	protected $_system_config = array();

	public function __construct($params = array())
	{
		// Set the super object to a local variable for use later
		$this->CI =& get_instance();

		// Are any config settings being passed manually?  If so, set them
		$config = is_array($params) ? $params : array();

		// Load the Sessions class
		$this->CI->load->driver('session', $config);
		$this->CI->load->database();
		//$this->CI->load->driver('database', $config);

		// get array from the session table
		$this->_system_config = $this->CI->session->userdata('system_config');
		if ($this->_system_config === NULL)
		{
			// No data exists so we'll set some base values
			$this->refresh();
		}
		
		log_message('info', 'System Config Class Initialized');
		
	}
	
	public function getConfig($var='')
	{
		if(!empty($var)){
			return	(isset($this->_system_config[$var]))? $this->_system_config[$var] : '';
		}else{
			return $this->_system_config;
		}
		
	}
	
	public function getConfigAll()
	{
		//$query= $this->CI->db->get('system_config');
		
		$this->CI->db->select('sc.id, config_name,	value, 	holder_class, 	input_selector_id, 	form_field_id, 	is_protected, form_type, note, form_option, query_id ');
		$this->CI->db->from('system_config sc'); 
		$this->CI->db->join('form_field ff', 'sc.form_field_id = ff.id', 'left');
		$query = $this->CI->db->get();
		//echo  $this->CI->db->last_query();
		
		$cdata = array();
		if(count($query->result_array())>0){
			foreach($query->result_array() as $value){
				$cdata[$value['id']] = array(
					'id'=>$value['id'],
					'config_name'=>$value['config_name'],
					'value'=>$value['value'],
					'holder_class'=>$value['holder_class'],
					'input_selector_id'=>$value['input_selector_id'],
					'form_field_id'=>$value['form_field_id'],
					'is_protected'=>$value['is_protected'],
					'form_type'=>$value['form_type'],
					'note'=>$value['note'],
					'form_option'=>$value['form_option'],
					'query_id'=>$value['query_id'],
					'data_opt'=> $this->getFormDataOption($value['form_field_id'])
				);
			}
		}
		
		return $cdata;
	}
	
	private function getFormDataOption($id)
	{
		$query = $this->CI->db->get_where('form_field_data_group', array('form_field_id' => $id));
		return $query->result_array();
	}

	public function refresh(){
			$query= $this->CI->db->get('system_config');
			
			if(count($query->result_array())>0){
				foreach($query->result_array() as $value){
					$this->_system_config[$value['config_name']] = $value['value'];
				}
			}
	}

}
