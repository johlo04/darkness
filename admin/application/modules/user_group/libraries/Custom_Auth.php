<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Custom_Auth extends Aauth {

	public $CI;

	public function __construct() {
		parent::__construct();
		$this->CI = & get_instance();
	}

	public function get_extra_info($user_id) {

		$this->CI->db->where('user_id', $user_id);
		$info = $this->CI->db->get('aauth_users_info');

		return $info->row_array();

	}

	public function get_user_group($user_id) {
		$this->CI->db->select('group_id');
		$this->CI->db->from('aauth_user_to_group');
		$this->CI->db->where('user_id', $user_id);
		$group_id = $this->CI->db->get();
		return $group_id->row_array();

	}

	public function add_extra_info($info) {

		$other_info = array(
			'user_id'	=>	$info['user_id'],
			'lastname'	=>	$info['lastname'],
			'firstname'	=>	$info['firstname'],
			'birthday'	=>	$info['birthday'],
			'contact_1'	=>	$info['contact_1'],
			'contact_2'	=>	$info['contact_2'],
			'address_1'	=>	$info['address_1'],
			'address_2'	=>	$info['address_2'],
			'status'	=>	1
		);

		$insert_info = $this->CI->db->insert('aauth_users_info', $other_info);

		$group_info = array(
			'user_id'	=>	$info['user_id'],
			'group_id'	=>	$info['group_id']
		);

		$insert_group = $this->CI->db->insert('aauth_user_to_group', $group_info);

		return ($insert_info && $insert_group) ? TRUE : FALSE;

	}

	public function get_group_info($group_id) {
		$info = $this->CI->db->get_where('aauth_groups', array('id' => $group_id));
		return $info->row_array();
	}

	public function get_permission_list() {
		$sql = "SELECT p.id AS id, p.name AS name, p.definition AS definition, pg.grant_show AS v_show, pg.grant_update AS v_update, pg.grant_delete AS v_delete
				FROM aauth_perms AS p
				LEFT JOIN tr_perms_grant AS pg 
				ON(p.id = pg.perm_id)";
		$list = $this->CI->db->query($sql);
		return $list->result();
	}

	public function get_permission_ids() {

		$this->CI->db->select('id');
		$ids = $this->CI->db->get('aauth_perms');
		
		$arr_id = array();
		$result = $ids->result_array();

		foreach($result as $r) {
			$arr_id[] = $r['id'];
		}

		return $arr_id;

	}

	public function add_grant_permission($perm, $group_id) {

		$get_if_existed = $this->CI->db->query("SELECT COUNT(DISTINCT(group_id)) AS total FROM tr_perms_grant WHERE group_id = " . $group_id);
		$result_existed = $get_if_existed->row_array('total');

		//remove existed
		if($result_existed > 0) {
			$this->CI->db->where('group_id', $group_id);
			$this->CI->db->delete('tr_perms_grant');
		} 
		
		$insert_perm = $this->CI->db->insert_batch('tr_perms_grant', $perm);

		return ($insert_perm) ? TRUE : FALSE;

	}

	public function delete_group_permission($perm_id = 0) {
		
		$this->CI->db->where('perm_id', $perm_id);
		$remove_perm = $this->CI->db->delete('tr_perms_grant');

		return ($remove_perm) ? TRUE : FALSE;
		
	}

	public function count_if_perm_exist($group_id) {
		$this->CI->db->where('group_id', $group_id);
		$this->CI->db->from('tr_perms_grant');
		return $this->CI->db->count_all_results();
	}

	public function get_grant_list($group_id) {
		$list = $this->CI->db->get_where('tr_perms_grant', array('group_id' => $group_id));
		return $list->result();
	}

	public function get_permission_name($perm_id) {
		$this->CI->db->select('name');
		$name = $this->CI->db->get_where('aauth_perms', array('id' => $perm_id));
		return $name->row_array('name');
	}

	public function check_if_username_same($user_id, $username) {
		$info = $this->CI->db->get_where('aauth_users', array('id' => $user_id, 'name' => $username));
		return ($info->result()) ? TRUE : FALSE;
	}

	public function check_if_username_exist($username) {
		$status = $this->CI->db->get_where('aauth_users', array('name' => $username));
		return $status->num_rows();
	}

	public function check_if_email_same($user_id, $email) {
		$info = $this->CI->db->get_where('aauth_users', array('id' => $user_id, 'email' => $email));
		return ($info->result()) ? TRUE : FALSE;
	}

	public function check_if_email_exist($email) {
		$status = $this->CI->db->get_where('aauth_users', array('email' => $email));
		return $status->num_rows();
	}

	public function is_user_belongs_to_group($user_id) {
		$stat = $this->CI->db->get_where('aauth_user_to_group', array('user_id' => $user_id));
		return $stat->num_rows();
	}

	public function is_user_has_details($user_id) {
		$stat = $this->CI->db->get_where('aauth_users_info', array('user_id' => $user_id));
		return $stat->num_rows();
	}

	/** overwrite update function **/
	public function update_user_info($info) {

		//fp($info);

		$sql_main_info = "UPDATE aauth_users SET email = '" . $info['email'] . "', name='" . $info['username'] . "' WHERE id = '" . $info['user_id'] . "'";
		$update_main_info = $this->CI->db->query($sql_main_info);

		if($update_main_info) {
			
			$has_details = $this->is_user_has_details($info['user_id']);


			if($has_details == 0) {
				$sql_other_info = "INSERT INTO aauth_users_info SET user_id = '" . $info['user_id'] . "', firstname = '" . $info['firstname'] . "', lastname = '" . $info['lastname'] . "', birthday = '" . $info['birthday'] . "', contact_1 = '" . $info['contact_1'] . "', contact_2 = '" . $info['contact_2'] . "', address_1 = '" . $info['address_1'] . "', address_2 = '" . $info['address_2'] . "', status = '" . $info['status'] . "'";
			} else {
				$sql_other_info = "UPDATE aauth_users_info SET firstname = '" . $info['firstname'] . "', lastname = '" . $info['lastname'] . "', birthday = '" . $info['birthday'] . "', contact_1 = '" . $info['contact_1'] . "', contact_2 = '" . $info['contact_2'] . "', address_1 = '" . $info['address_1'] . "', address_2 = '" . $info['address_2'] . "', status = '" . $info['status'] . "' WHERE user_id = '" . $info['user_id'] . "'";
			}

			$update_other_info = $this->CI->db->query($sql_other_info);

			if($update_other_info) {

				$has_group = $this->is_user_belongs_to_group($info['user_id']);

				//fd($has_group);

				if($has_group == 0) {
					$sql_user_group = "INSERT INTO aauth_user_to_group SET group_id = '" . $info['group_id'] . "', user_id = '" . $info['user_id'] . "'";
					$update_user_group = $this->CI->db->query($sql_user_group);
				} else {
					$sql_user_group = "UPDATE aauth_user_to_group SET group_id = '" . $info['group_id'] . "' WHERE user_id = '" . $info['user_id'] . "'";
					$update_user_group = $this->CI->db->query($sql_user_group);
				}

				return ($update_main_info && $update_other_info && $update_user_group) ? TRUE : FALSE;


			} else {
				fd('not ok');
				return FALSE;
			}

		} else {
			return FALSE;
		}

	}

	public function reset_user_password($user_id, $password) {
		$sql_update = "UPDATE aauth_users SET pass = '" . $password . "' WHERE id = '" . $user_id . "'";
		$update_password = $this->CI->db->query($sql_update);
		return ($update_password) ? TRUE : FALSE;
	}

	public function get_user_username($user_id) {
		$username = $this->CI->db->get_where('aauth_users', array('id'=>$user_id));
		return $username->row_array();
	}

	public function get_user_code($user_id) {
		$this->CI->db->select('name');
		$this->CI->db->where('id', $user_id);
		$result = $this->CI->db->get('aauth_users');
		$name = $result->row_array();
		return $name['name'];
	}

	public function get_user_group_id($user_id) {
		$this->CI->db->select('group_id');
		$this->CI->db->where('user_id', $user_id);
		$group_id = $this->CI->db->get('aauth_user_to_group');
		$result_group = $group_id->row_array();
		return $result_group['group_id'];
	}
	
	public function get_permission_id($permission_id) {
		$this->CI->db->select('id');
		$this->CI->db->where('id', $permission_id);
		$perm = $this->CI->db->get('aauth_perms');
		$result_perm = $perm->row_array();
		return $result_perm['id'];
		
	}
	
	public function validateUserAccess($user_id, $module) {
		
		$group_id  = $this->get_user_group_id($user_id);
		
		//get module ID
		$this->CI->db->select('id');
		$this->CI->db->where('name', $module);
		$query_module_id = $this->CI->db->get('aauth_perms');
		$result_module = $query_module_id->row_array();
		$module_id = $result_module['id'];

		//get permissions on module
		$this->CI->db->select('grant_show, grant_update, grant_delete');
		$this->CI->db->where('group_id', $group_id);
		$this->CI->db->where('perm_id', $module_id);
		$query_permission = $this->CI->db->get('tr_perms_grant');
		$result_permission = $query_permission->row_array();

		return $result_permission;

	}

	public function validateUserUpdate($user_id, $module) {
		$group_id  = $this->get_user_group_id($user_id);
		
		//get module ID
		$this->CI->db->select('id');
		$this->CI->db->where('name', $module);
		$query_module_id = $this->CI->db->get('aauth_perms');
		$result_module = $query_module_id->row_array();
		$module_id = $result_module['id'];

		//get permissions on module
		$this->CI->db->select('grant_show, grant_update, grant_delete');
		$this->CI->db->where('group_id', $group_id);
		$this->CI->db->where('perm_id', $module_id);
		$query_permission = $this->CI->db->get('tr_perms_grant');
		$result_permission = $query_permission->row_array();

		return $result_permission;
	}

	public function redirect_denied($permissions, $grant) {
		if($grant == 'show') {
			if($permissions['grant_show'] == 1) {
				return false;
			} else {
				redirect('errors/errors/autorized_only');
			}
		}
		if($grant == 'update') {
			if($permissions['grant_update'] == 1) {
				return false;
			} else {
				
			}
		}
		if($grant == 'delete') {
			if($permissions['grant_delete'] == 1) {
				return false;
			} else {
				
			}
		}
	}

}

?>