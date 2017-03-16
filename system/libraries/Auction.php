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
 
class CI_Auction {
	
	//protected $_system_config = array();
	
	public function __construct($params = array())
	{
		// Set the super object to a local variable for use later
		$this->CI =& get_instance();
		$this->CI->load->database();

		log_message('info', 'Auction Class Initialized');
		
	}
	
	public function refresh(){
			$query= $this->CI->db->query('SELECT * FROM users WHERE created >= NOW()');
			
			$query->result_array();
			
	}

}
