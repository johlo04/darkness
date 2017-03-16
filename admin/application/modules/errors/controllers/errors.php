<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Errors extends MX_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function show_404() {
		
		$data = array();
		$data['system_title'] = 'Terada - Dashboard';
		$data['header'] = modules::run('common/header/index', $data);
		$data['sidebar_left'] = modules::run('common/sidebar_left/index', $data);
		$data['footer'] = modules::run('common/footer/index', $data);

		$this->load->view('show_404', $data);

	}

	public function autorized_only() {

		$data = array();

		$data['breadcrumb'] = array(
			'home' => site_url('users/user'),
			'authorized page' => site_url('errors/errors/autorized_only'),
		);

		$data['system_title'] = 'Terada -  Restrict Page';
		$data['page_title'] = 'Authorized users only';
		$data['page'] = $this->uri->segment(4);
		$data['header'] = modules::run('common/header/index', $data);
		$data['sidebar_left'] = modules::run('common/sidebar_left/index', $data);
		$data['footer'] = modules::run('common/footer/index', $data);

		$this->load->view('show_autorized', $data);
	}

}

?>