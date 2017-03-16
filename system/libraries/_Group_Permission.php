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
 
class Group_Permission{

	public $user_id = 0;
	public $group_id = 0;
	
	public function __construct($params = array())
	{
	
		$this->CI =& get_instance();
		$this->CI->load->database();
	
		log_message('info', 'Group Permission Class Initialized');
		if($this->CI->session->userdata('id')){
			$this->user_id = $this->CI->session->userdata('id');
		}else{
			$this->user_id =  0;
		}
		
		$this->group_id = $this->getGroup($this->user_id);
	
	}
	
	public function getGroup($user_id){
	
		$this->CI->db->select('group_id');
    	$this->CI->db->where('user_id', $user_id);
    	$group_id = $this->CI->db->get('aauth_user_to_group');
		return $group_id->row('group_id');
		
	}
	
	public function getFilePath($path='application/modules'){
	
		$list = (scandir(FCPATH.$path));
		$clean =  array_diff($list, array('.','..'));
		
		return $clean;
	}
	
	//returns array
	
	public function set_permission($data, $group_id=''){ // return all
		
		$rowdata['id'] = $data['id'];
		$rowdata['name'] = $data['name'];
		$rowdata['definition'] = $data['definition'];
		$rowdata['view_privilege'] = (isset($data['view_privilege']))? implode(',',$data['view_privilege']) : 0;
		$rowdata['modify_privilege'] = (isset($data['modify_privilege']))? implode(',',$data['modify_privilege']) :  0;
		$rowdata['delete_privilege'] = (isset($data['delete_privilege']))?  implode(',',$data['delete_privilege']) :  0;
		$rowdata['special_privilege'] = (isset($data['special_privilege']))? implode(',',$data['special_privilege']) :  0;
		unset($data);
		//fd($rowdata);
		if(empty($group_id)){
			
			$this->CI->db->insert('aauth_groups', $rowdata);
			$group_id= $this->CI->db->insert_id();
			
		}else{
		
			$this->CI->db->where('id',$group_id);
			$this->CI->db->update('aauth_groups', $rowdata);
		}
		
		return $group_id;
		
	}
	
	public function get_permission($group_id=0){ // return all
	
		$this->CI->db->where('id',$group_id);
		$this->CI->db->from('aauth_groups');
		$query = $this->CI->db->get();
		
		return ($query) ? $query->row_array(): array();
	}
	
	public function get_view_permission($group_id=0){ // view_privilege only
		$this->CI->db->select('view_privilege');
		
		$this->CI->db->where('id',$group_id);
		$this->CI->db->from('aauth_groups');
		$query = $this->CI->db->get();

		return ($query) ? $query->row_array(): array();
	}
	
	public function get_modify_permission($group_id=0){
		
		$this->CI->db->select('modify_privilege');
		
		$this->CI->db->where('id',$group_id);
		$this->CI->db->from('aauth_groups');
		$query = $this->CI->db->get();

		return ($query) ? $query->row_array(): array();
	}
	
	public function get_delete_permission($group_id=0){
		$this->CI->db->select('delete_privilege');
		
		$this->CI->db->where('id',$group_id);
		$this->CI->db->from('aauth_groups');
		$query = $this->CI->db->get();
		
		return ($query) ? $query->row_array(): array();
	}
	
	public function get_special_permission($group_id=0){
		$this->CI->db->select('special_privilege');
		
		$this->CI->db->where('id',$group_id);
		$this->CI->db->from('aauth_groups');
		$query = $this->CI->db->get();
		
		return ($query) ? $query->row_array(): array();
	}
	
	//not available
	public function get_user_permission($module=''){
		return false;
	}
	
	//returns bool the group id is based on the login user
	public function is_allow_access($module,$redirect=1){ //show access to module or act like is_allow_view(); returns true or false;
		
		$this->CI->db->where('id',$this->group_id);
		$where = "FIND_IN_SET('".$module."',view_privilege) !="; 
		$this->CI->db->where($where,0);
		$this->CI->db->from('aauth_groups');
		
		$count = $this->CI->db->count_all_results();
		if($count){
			return true;
		}else{
			if(empty($this->group_id) || $this->group_id<=0){
				redirect('users/auth');
			}elseif($redirect){
				redirect('errors/errors/autorized_only/'.$module);
			}
			return false;
		}
	}
	
	public function is_allow_view($module){
		
		$this->CI->db->where('id',$this->group_id);
		$where = "FIND_IN_SET('".$module."',view_privilege) !="; 
		$this->CI->db->where($where,0);
		$this->CI->db->from('aauth_groups');

		$count = $this->CI->db->count_all_results();
		
		return ($count)? true: false;
	}
	
	public function delete_group($group_id){
		
		$this->CI->db->delete('aauth_groups',array('id'=>$group_id));
	
		return true;
	}
	
	public function is_allow_modify($module){
		
		$this->CI->db->where('id',$this->group_id);
		$where = "FIND_IN_SET('".$module."',modify_privilege) !="; 
		$this->CI->db->where($where,0);
		$this->CI->db->from('aauth_groups');
		
		$count = $this->CI->db->count_all_results();
		
		return ($count)? true: false;
	}
	
	public function is_allow_delete($module){
		$this->CI->db->where('id',$this->group_id);
		$where = "FIND_IN_SET('".$module."',delete_privilege) !="; 
		$this->CI->db->where($where,0);
		$this->CI->db->from('aauth_groups');
		
		$count = $this->CI->db->count_all_results();
		
		return ($count)? true: false;
	}
	
	public function is_allow_special($module){
		$this->CI->db->where('id',$this->group_id);
		$where = "FIND_IN_SET('".$module."',special_privilege) !="; 
		$this->CI->db->where($where,0);
		$this->CI->db->from('aauth_groups');
		
		$count = $this->CI->db->count_all_results();
		
		return ($count)? true: false;
	}
	
	// not available
	public function is_allow_user($module){
		return false;
	}

}
