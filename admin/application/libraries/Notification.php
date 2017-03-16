<?php
/** 
 * CodeIgniter
 *
 * @copyright	Copyright (c) Flax, Inc. (https://flax.ph/)
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Notification class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @author		Jolo Pedrocillo
 */
 
class Notification {
	
	protected $_notification = array();
	private $_posted_to_id = 0;
	private $_id_pointer = 0;
	private $_path_group = '';
	

	public function __construct($params = array())
	{
		// Set the super object to a local variable for use later
		$this->CI =& get_instance();

		// Load the Sessions class
		$this->CI->load->database();
	
		log_message('info', 'Notification Class Initialized');
		
	}
	
	public function getNotification($_posted_to_id,$limit=5){
			
			$this->CI->db->limit($limit);
			$this->CI->db->where(array('posted_to_id'=>$_posted_to_id));
			$this->CI->db->order_by('is_check desc, date_added asc');
			$query = $this->CI->db->get('notification');
			
			
			if(count($query->result_array())>0){
				//foreach($query->result_array() as $value){
					$this->_notification = $query->result_array();
				//}
			}
			
		return $this->_notification;	
	}
	
	public function updateCheckNotification($_id_pointer, $_posted_to_id, $_path_group){

		$data = array('id_pointer'=>$_id_pointer,'posted_to_id'=>$_posted_to_id,'path_group'=>$_path_group,'is_check'=>0);
		
		$this->CI->db->where($data);
		$this->CI->db->update('notification',array('is_check'=>1));
		
		return false;
		
	}
	
	public function postNotification($data){

		$this->CI->db->set('date_added', date('Y-m-d h:i:s'));
		$this->CI->db->set('is_check', 0);
		
		$query= $this->CI->db->insert('notification',$data);
		return false;
		
	}
	
	public function getCountNewNotication($_posted_to_id){
		
		$this->CI->db->where(array('is_check'=>0,'posted_to_id'=>$_posted_to_id));
		$this->CI->db->from('notification');
		
		return $this->CI->db->count_all_results();
	}

}
