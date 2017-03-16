<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sidebar_Left extends MX_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index($data = array()) {

		$total = count($this->uri->segment_array());
		$data['module'] = $this->uri->segment($total);
		$this->load->view('common/sidebar_left', $data);
	}

}

?>