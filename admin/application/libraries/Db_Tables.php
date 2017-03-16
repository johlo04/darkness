<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Db_tables extends CI_Db {

	public $CI;

	public function clean() {
		$this->CI->db->list_fields();
	}

}

?>