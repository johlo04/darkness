<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
* Custom UserLib
* By: Rochelle Canale
**/
class User_Lib {

	private $CI;
	private $user_id;
	private $name;
	private $email;

	public function __construct($params = array()) {
		$this->CI =& get_instance();
		$this->CI->load->database();
	}

	/** restrict account edit to others **/
	public function validate_user_update($user_id) {

        $sess_user_id = $this->CI->session->userdata('id');

        if($sess_user_id == 1 || $sess_user_id == 2) {
        	return TRUE;
        } else if($user_id == $sess_user_id) {
            return TRUE;
        } else {
            redirect(site_url('errors/errors/autorized_only'));
        }
       
    }

    /** validate views **/
    public function validateGrantView($user_id, $module) {
    	$this->CI->db->select('group_id');
    	$this->CI->db->where('user_id', $user_id);
    	$group_id = $this->CI->db->get('aauth_user_to_group');
		return $group_id;
    	
    }


}

?>