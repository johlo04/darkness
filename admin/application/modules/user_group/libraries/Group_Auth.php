<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Group_Auth extends Aauth {

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